const { spawn } = require('child_process');
const fs = require('fs');

const ARTIFACT_DIR = 'C:\\Users\\VNR\\.gemini\\antigravity\\brain\\fd99593f-c519-4441-8748-b992faabfc5a';

async function main() {
    const chrome = spawn('C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe', [
        '--headless=new',
        '--remote-debugging-port=9491',
        '--window-size=375,812',
        '--disable-gpu',
        '--user-data-dir=C:\\Users\\VNR\\AppData\\Local\\Temp\\chrome_mob_' + Date.now(),
        '--no-sandbox',
        'about:blank'
    ]);

    let list = null;
    for (let i = 0; i < 20; i++) {
        await new Promise(r => setTimeout(r, 400));
        try {
            const listRes = await fetch('http://127.0.0.1:9491/json/list');
            list = await listRes.json();
            if (list && list.length) break;
        } catch (e) {}
    }
    let target = list.find(t => t.type === 'page') || list[0];
    const ws = new WebSocket(target.webSocketDebuggerUrl);
    let id = 1;
    const callbacks = new Map();
    ws.onmessage = (e) => {
        const m = JSON.parse(e.data);
        if (m.id && callbacks.has(m.id)) {
            const cb = callbacks.get(m.id);
            callbacks.delete(m.id);
            cb(m.result);
        }
    };
    function send(method, params = {}) {
        return new Promise(res => {
            const msgId = id++;
            callbacks.set(msgId, res);
            ws.send(JSON.stringify({ id: msgId, method, params }));
        });
    }
    await new Promise(r => ws.onopen = r);
    await send('Page.enable');
    await send('Runtime.enable');
    await send('Emulation.setDeviceMetricsOverride', {
        width: 375,
        height: 812,
        deviceScaleFactor: 2,
        mobile: true
    });

    const pages = [
        { name: 'home', url: 'http://127.0.0.1:8000/' },
        { name: 'about', url: 'http://127.0.0.1:8000/about-us' },
        { name: 'applications', url: 'http://127.0.0.1:8000/applications' },
        { name: 'certifications', url: 'http://127.0.0.1:8000/certifications' },
        { name: 'sustainability', url: 'http://127.0.0.1:8000/sustainability' },
        { name: 'contact', url: 'http://127.0.0.1:8000/contact' },
        { name: 'blogs', url: 'http://127.0.0.1:8000/blogs' },
        { name: 'vat_dyes', url: 'http://127.0.0.1:8000/vat-dyes' },
    ];

    const report = [];
    for (const p of pages) {
        await send('Page.navigate', { url: p.url });
        await new Promise(r => setTimeout(r, 2500));

        const evalRes = await send('Runtime.evaluate', {
            expression: `(() => {
                const sw = document.documentElement.scrollWidth;
                const iw = window.innerWidth;
                const sh = document.documentElement.scrollHeight;
                const overflowing = [];
                document.querySelectorAll('section, div, img, table, iframe, form, h1, h2, p, ul').forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.width > 0 && (rect.right > iw + 2 || rect.left < -2)) {
                        overflowing.push({
                            tag: el.tagName,
                            cls: (el.className || '').toString().slice(0, 60),
                            left: Math.round(rect.left),
                            right: Math.round(rect.right),
                            width: Math.round(rect.width)
                        });
                    }
                });
                const largeSpacing = [];
                document.querySelectorAll('section.elementor-section, .elementor-top-section, .elementor-widget-wrap').forEach(el => {
                    const cs = window.getComputedStyle(el);
                    const pt = parseInt(cs.paddingTop) || 0;
                    const pb = parseInt(cs.paddingBottom) || 0;
                    const mt = parseInt(cs.marginTop) || 0;
                    const mb = parseInt(cs.marginBottom) || 0;
                    if (pt >= 45 || pb >= 45 || mt >= 45 || mb >= 45) {
                        largeSpacing.push({
                            cls: (el.className || '').toString().match(/elementor-element-[a-z0-9]+/)?.[0] || el.className.toString().slice(0, 40),
                            pt, pb, mt, mb
                        });
                    }
                });
                const unstackedCols = [];
                document.querySelectorAll('.elementor-column').forEach(col => {
                    const rect = col.getBoundingClientRect();
                    if (rect.width > 0 && rect.width < 320 && !col.closest('header') && !col.closest('footer')) {
                        unstackedCols.push({
                            cls: (col.className || '').toString().match(/elementor-element-[a-z0-9]+/)?.[0] || 'col',
                            width: Math.round(rect.width)
                        });
                    }
                });
                const mobileToggle = document.querySelector('.elementor-menu-toggle');
                const toggleVisible = mobileToggle ? window.getComputedStyle(mobileToggle).display !== 'none' : false;
                const desktopMenu = document.querySelector('.elementor-nav-menu--main');
                const desktopMenuVisible = desktopMenu ? window.getComputedStyle(desktopMenu).display !== 'none' : false;

                return JSON.stringify({
                    scrollWidth: sw,
                    innerWidth: iw,
                    scrollHeight: sh,
                    overflowCount: overflowing.length,
                    overflowing: overflowing.slice(0, 8),
                    largeSpacing: largeSpacing.slice(0, 10),
                    unstackedCols: unstackedCols.slice(0, 10),
                    toggleVisible,
                    desktopMenuVisible
                });
            })()`
        });

        const metrics = JSON.parse(evalRes.result.value);
        report.push({ page: p.name, url: p.url, ...metrics });

        // Take top + mid screenshots for key pages
        const snap = await send('Page.captureScreenshot', { format: 'png' });
        fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_audit_${p.name}.png`, Buffer.from(snap.data, 'base64'));
    }

    console.log(JSON.stringify(report, null, 2));
    chrome.kill();
}

main().catch(err => {
    console.error(err);
    process.exit(1);
});

