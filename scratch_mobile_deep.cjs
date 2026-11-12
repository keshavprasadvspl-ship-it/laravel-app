const { spawn } = require('child_process');
const fs = require('fs');

const ARTIFACT_DIR = 'C:\\Users\\VNR\\.gemini\\antigravity\\brain\\fd99593f-c519-4441-8748-b992faabfc5a';

async function main() {
    const chrome = spawn('C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe', [
        '--headless=new',
        '--remote-debugging-port=9492',
        '--window-size=375,812',
        '--disable-gpu',
        '--user-data-dir=C:\\Users\\VNR\\AppData\\Local\\Temp\\chrome_mob_deep_' + Date.now(),
        '--no-sandbox',
        'about:blank'
    ]);

    let list = null;
    for (let i = 0; i < 20; i++) {
        await new Promise(r => setTimeout(r, 400));
        try {
            const listRes = await fetch('http://127.0.0.1:9492/json/list');
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

    // 1. Inspect why there is empty space at top of inner pages on mobile
    await send('Page.navigate', { url: 'http://127.0.0.1:8000/about-us' });
    await new Promise(r => setTimeout(r, 2000));
    const topSpaceInfo = await send('Runtime.evaluate', {
        expression: `(() => {
            const header = document.querySelector('.elementor-location-header');
            const content = document.querySelector('#content');
            const article = document.querySelector('#content article');
            const firstSection = document.querySelector('#content section');
            const hRect = header ? header.getBoundingClientRect() : null;
            const cRect = content ? content.getBoundingClientRect() : null;
            const aRect = article ? article.getBoundingClientRect() : null;
            const fRect = firstSection ? firstSection.getBoundingClientRect() : null;
            const cCs = content ? window.getComputedStyle(content) : null;
            const astCs = document.querySelector('#content .ast-container') ? window.getComputedStyle(document.querySelector('#content .ast-container')) : null;
            const entryCs = document.querySelector('.entry-content') ? window.getComputedStyle(document.querySelector('.entry-content')) : null;
            const artCs = article ? window.getComputedStyle(article) : null;
            const fsCs = firstSection ? window.getComputedStyle(firstSection) : null;
            const e2835 = document.querySelector('.elementor-2835') ? window.getComputedStyle(document.querySelector('.elementor-2835')) : null;
            const headerChildren = [];
            document.querySelectorAll('.elementor-location-header .elementor-section').forEach(s => {
                const r = s.getBoundingClientRect();
                headerChildren.push({ cls: s.className.match(/elementor-element-[a-z0-9]+/)?.[0], top: r.top, bottom: r.bottom, height: r.height });
            });
            return JSON.stringify({
                header: hRect,
                headerChildren,
                contentTop: cRect?.top,
                contentPadTop: cCs?.paddingTop,
                astPadTop: astCs?.paddingTop,
                artTop: aRect?.top,
                artPadTop: artCs?.paddingTop,
                entryPadTop: entryCs?.paddingTop,
                e2835PadTop: e2835?.paddingTop,
                firstSecTop: fRect?.top,
                firstSecPadTop: fsCs?.paddingTop
            }, null, 2);
        })()`
    });
    console.log('TOP SPACE INFO:', topSpaceInfo.result.value);

    // 2. Inspect Homepage sections on mobile + footer + hamburger click
    await send('Page.navigate', { url: 'http://127.0.0.1:8000/' });
    await new Promise(r => setTimeout(r, 2500));

    // Scroll to 750 (feature boxes), 2000 (overview), 4500 (stats/testimonials), bottom (footer)
    await send('Runtime.evaluate', { expression: 'window.scrollTo(0, 750);' });
    await new Promise(r => setTimeout(r, 500));
    fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_home_s2.png`, Buffer.from((await send('Page.captureScreenshot', { format: 'png' })).data, 'base64'));

    await send('Runtime.evaluate', { expression: 'window.scrollTo(0, 2200);' });
    await new Promise(r => setTimeout(r, 500));
    fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_home_s3.png`, Buffer.from((await send('Page.captureScreenshot', { format: 'png' })).data, 'base64'));

    await send('Runtime.evaluate', { expression: 'window.scrollTo(0, document.body.scrollHeight - 900);' });
    await new Promise(r => setTimeout(r, 500));
    fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_home_footer.png`, Buffer.from((await send('Page.captureScreenshot', { format: 'png' })).data, 'base64'));

    // Click mobile hamburger menu at top
    await send('Runtime.evaluate', { expression: 'window.scrollTo(0, 0); document.querySelector(".elementor-menu-toggle")?.click();' });
    await new Promise(r => setTimeout(r, 500));
    fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_menu_open.png`, Buffer.from((await send('Page.captureScreenshot', { format: 'png' })).data, 'base64'));

    // 3. Check a product detail page
    await send('Page.navigate', { url: 'http://127.0.0.1:8000/vat-dyes' });
    await new Promise(r => setTimeout(r, 2000));
    await send('Runtime.evaluate', { expression: 'window.scrollTo(0, 800);' });
    await new Promise(r => setTimeout(r, 500));
    fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_vat_dyes_mid.png`, Buffer.from((await send('Page.captureScreenshot', { format: 'png' })).data, 'base64'));

    // Find first product link and visit it
    const prodHref = await send('Runtime.evaluate', {
        expression: `document.querySelector('a[href*="/vat-"]')?.href || document.querySelector('.product-card a, article a')?.href || ''`
    });
    if (prodHref.result.value) {
        await send('Page.navigate', { url: prodHref.result.value });
        await new Promise(r => setTimeout(r, 2000));
        fs.writeFileSync(`${ARTIFACT_DIR}\\mobile_product_detail.png`, Buffer.from((await send('Page.captureScreenshot', { format: 'png' })).data, 'base64'));
    }

    chrome.kill();
}

main().catch(console.error);

