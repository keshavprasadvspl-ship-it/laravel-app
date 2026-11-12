const { spawn } = require('child_process');
const path = require('path');

const ARTIFACT_DIR = 'C:\\Users\\VNR\\.gemini\\antigravity\\brain\\fd99593f-c519-4441-8748-b992faabfc5a';

async function main() {
    const chrome = spawn('C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe', [
        '--headless=new',
        '--remote-debugging-port=9494',
        '--window-size=375,812',
        '--disable-gpu',
        '--user-data-dir=C:\\Users\\VNR\\AppData\\Local\\Temp\\chrome_mob_ver_' + Date.now(),
        '--no-sandbox',
        'about:blank'
    ]);

    let list = null;
    for (let i = 0; i < 20; i++) {
        await new Promise(r => setTimeout(r, 400));
        try {
            const listRes = await fetch('http://127.0.0.1:9494/json/list');
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
    await send('Emulation.setDeviceMetricsOverride', {
        width: 375,
        height: 812,
        deviceScaleFactor: 2,
        mobile: true
    });

    async function evalJS(expr) {
        const res = await send('Runtime.evaluate', { expression: expr, returnByValue: true });
        return res.result ? res.result.value : null;
    }

    async function snap(filename, fullPage = false) {
        const res = await send('Page.captureScreenshot', { format: 'png', captureBeyondViewport: fullPage });
        require('fs').writeFileSync(path.join(ARTIFACT_DIR, filename), Buffer.from(res.data, 'base64'));
    }

    const routes = [
        { url: 'http://127.0.0.1:8000/', name: 'home' },
        { url: 'http://127.0.0.1:8000/about-us', name: 'about' },
        { url: 'http://127.0.0.1:8000/applications', name: 'applications' },
        { url: 'http://127.0.0.1:8000/certifications', name: 'certifications' },
        { url: 'http://127.0.0.1:8000/sustainability', name: 'sustainability' },
        { url: 'http://127.0.0.1:8000/contact', name: 'contact' },
        { url: 'http://127.0.0.1:8000/blogs', name: 'blogs' },
        { url: 'http://127.0.0.1:8000/vat-dyes', name: 'vat_dyes' },
        { url: 'http://127.0.0.1:8000/products', name: 'products' },
        { url: 'http://127.0.0.1:8000/request-quote', name: 'quote' }
    ];

    const report = [];
    for (const r of routes) {
        await send('Page.navigate', { url: r.url });
        await new Promise(res => setTimeout(res, 1800));
        await evalJS('window.scrollTo(0, 0)');
        await new Promise(res => setTimeout(res, 200));

        const metrics = await evalJS(`(() => {
            const doc = document.documentElement;
            const badge = document.querySelector('.grecaptcha-badge');
            const badgeCS = badge ? getComputedStyle(badge) : null;
            const h850 = document.querySelector('.elementor-element-850d87a');
            const h339 = document.querySelector('.elementor-element-3397fd0b');
            const content = document.querySelector('#content');
            const firstSec = document.querySelector('#content section');
            return {
                status200: document.body && document.body.innerText.length > 50,
                scrollWidth: doc.scrollWidth,
                clientWidth: doc.clientWidth,
                overflowX: doc.scrollWidth > doc.clientWidth,
                scrollHeight: document.body.scrollHeight,
                headerHeight: (h850 ? h850.getBoundingClientRect().height : 0) + (h339 ? h339.getBoundingClientRect().height : 0),
                topGap: (content && firstSec) ? Math.round(firstSec.getBoundingClientRect().top - content.getBoundingClientRect().top) : null,
                badgeHidden: !badge || badgeCS.display === 'none' || badge.getBoundingClientRect().width === 0
            };
        })()`);
        report.push({ route: r.name, ...metrics });
        await snap(`mob_fixed_${r.name}_top.png`);
    }

    // Deep check on Home: Overview cols + mobile menu + submenu expand + footer
    await send('Page.navigate', { url: 'http://127.0.0.1:8000/' });
    await new Promise(res => setTimeout(res, 1800));

    // Check overview section spacing and capture scrolled view
    const homeChecks = await evalJS(`(() => {
        const s45 = document.querySelector('.elementor-element-45040261');
        const cols = s45 ? Array.from(s45.querySelectorAll('.elementor-column')).map(c => ({
            h: Math.round(c.getBoundingClientRect().height),
            top: Math.round(c.getBoundingClientRect().top)
        })) : [];
        const hero = document.querySelector('.elementor-element-6dada31 .swiper-slide');
        const heroRect = hero ? hero.getBoundingClientRect() : null;
        return {
            hero: heroRect ? { w: Math.round(heroRect.width), h: Math.round(heroRect.height), left: Math.round(heroRect.left) } : null,
            overviewTop: s45 ? Math.round(s45.getBoundingClientRect().top) : null,
            overviewCols: cols
        };
    })()`);

    // Scroll to overview section
    if (homeChecks.overviewTop) {
        await evalJS(`window.scrollTo(0, ${Math.max(0, homeChecks.overviewTop - 80)})`);
        await new Promise(res => setTimeout(res, 300));
        await snap('mob_fixed_home_overview.png');
    }

    // Scroll to stats/testimonials + footer
    await evalJS(`window.scrollTo(0, document.body.scrollHeight - 1600)`);
    await new Promise(res => setTimeout(res, 300));
    await snap('mob_fixed_home_mid2.png');
    await evalJS(`window.scrollTo(0, document.body.scrollHeight - 812)`);
    await new Promise(res => setTimeout(res, 300));
    await snap('mob_fixed_home_footer.png');

    // Back to top and test Hamburger toggle + Products submenu toggle
    await evalJS('window.scrollTo(0, 0)');
    await new Promise(res => setTimeout(res, 200));
    const menuCheck = await evalJS(`(() => {
        const btn = document.querySelector('.elementor-menu-toggle');
        if (btn) btn.click();
        const dd = document.querySelector('nav.elementor-nav-menu--dropdown');
        const prodToggle = dd ? dd.querySelector('li.menu-item-2977 .sd-mob-sub-toggle') : null;
        if (prodToggle) prodToggle.click();
        const ddRect = dd ? dd.getBoundingClientRect() : null;
        const subMenu = dd ? dd.querySelector('li.menu-item-2977 > ul.sub-menu') : null;
        return {
            menuOpen: dd ? dd.classList.contains('sd-mobile-open') : false,
            ddRect: ddRect ? { w: Math.round(ddRect.width), h: Math.round(ddRect.height), left: Math.round(ddRect.left), top: Math.round(ddRect.top) } : null,
            subOpen: subMenu ? getComputedStyle(subMenu).display : null
        };
    })()`);
    await snap('mob_fixed_menu_open.png');

    // Also visit first blog post and first product detail from vat-dyes
    await send('Page.navigate', { url: 'http://127.0.0.1:8000/blogs' });
    await new Promise(res => setTimeout(res, 1500));
    const firstBlogHref = await evalJS(`(() => { const a = document.querySelector('.elementor-post__title a'); return a ? a.href : null; })()`);
    if (firstBlogHref) {
        await send('Page.navigate', { url: firstBlogHref });
        await new Promise(res => setTimeout(res, 1500));
        const blogDetMetrics = await evalJS(`({ scrollWidth: document.documentElement.scrollWidth, clientWidth: document.documentElement.clientWidth })`);
        report.push({ route: 'blog_detail', url: firstBlogHref, ...blogDetMetrics });
        await snap('mob_fixed_blog_detail.png');
    }

    await send('Page.navigate', { url: 'http://127.0.0.1:8000/vat-dyes' });
    await new Promise(res => setTimeout(res, 1500));
    const firstProdHref = await evalJS(`(() => { const a = document.querySelector('.product-catalog-card a.prod-name'); return a ? a.href : null; })()`);
    if (firstProdHref) {
        await send('Page.navigate', { url: firstProdHref });
        await new Promise(res => setTimeout(res, 1500));
        const prodDetMetrics = await evalJS(`({ scrollWidth: document.documentElement.scrollWidth, clientWidth: document.documentElement.clientWidth })`);
        report.push({ route: 'product_detail', url: firstProdHref, ...prodDetMetrics });
        await snap('mob_fixed_product_detail.png');
    }

    console.log('=== ROUTE REPORT ===');
    console.log(JSON.stringify(report, null, 2));
    console.log('=== HOME CHECKS ===');
    console.log(JSON.stringify(homeChecks, null, 2));
    console.log('=== MENU CHECK ===');
    console.log(JSON.stringify(menuCheck, null, 2));

    ws.close();
    chrome.kill();
}

main().catch(e => { console.error(e); process.exit(1); });

