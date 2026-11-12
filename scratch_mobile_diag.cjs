const { spawn } = require('child_process');

async function main() {
    const chrome = spawn('C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe', [
        '--headless=new',
        '--remote-debugging-port=9493',
        '--window-size=375,812',
        '--disable-gpu',
        '--user-data-dir=C:\\Users\\VNR\\AppData\\Local\\Temp\\chrome_mob_diag_' + Date.now(),
        '--no-sandbox',
        'about:blank'
    ]);

    let list = null;
    for (let i = 0; i < 20; i++) {
        await new Promise(r => setTimeout(r, 400));
        try {
            const listRes = await fetch('http://127.0.0.1:9493/json/list');
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

    await send('Page.navigate', { url: 'http://127.0.0.1:8000/' });
    await new Promise(r => setTimeout(r, 2500));

    const homeDiag = await evalJS(`(() => {
        const toggle = document.querySelector('.elementor-menu-toggle');
        if (toggle) toggle.click();
        const dd = document.querySelector('nav.elementor-nav-menu--dropdown');
        const ddStyles = dd ? getComputedStyle(dd) : null;
        const ddRect = dd ? dd.getBoundingClientRect() : null;
        const ddParent = dd && dd.parentElement ? getComputedStyle(dd.parentElement) : null;
        const s45 = document.querySelector('.elementor-element-45040261');
        const s45Cols = s45 ? Array.from(s45.querySelectorAll('.elementor-column')).map(c => ({
            cls: c.className,
            rect: c.getBoundingClientRect(),
            display: getComputedStyle(c).display,
            width: getComputedStyle(c).width,
            visibility: getComputedStyle(c).visibility,
            opacity: getComputedStyle(c).opacity,
            overflow: getComputedStyle(c).overflow,
            height: getComputedStyle(c).height,
            textSnippet: c.innerText.trim().slice(0, 120)
        })) : [];
        const s45Widgets = s45 ? Array.from(s45.querySelectorAll('.elementor-widget')).map(w => ({
            cls: w.className,
            rect: w.getBoundingClientRect(),
            display: getComputedStyle(w).display,
            opacity: getComputedStyle(w).opacity,
            visibility: getComputedStyle(w).visibility,
            color: getComputedStyle(w).color
        })) : [];
        const s45Rect = s45 ? s45.getBoundingClientRect() : null;
        const s45Row = s45 ? s45.querySelector('.elementor-row') : null;
        const s45RowCS = s45Row ? getComputedStyle(s45Row) : null;

        return {
            dd: dd ? {
                inlineDisplay: dd.style.display,
                display: ddStyles.display,
                visibility: ddStyles.visibility,
                opacity: ddStyles.opacity,
                maxHeight: ddStyles.maxHeight,
                transform: ddStyles.transform,
                height: ddStyles.height,
                position: ddStyles.position,
                zIndex: ddStyles.zIndex,
                top: ddStyles.top,
                left: ddStyles.left,
                width: ddStyles.width,
                overflow: ddStyles.overflow,
                rect: ddRect,
                parentOverflow: ddParent ? ddParent.overflow : null,
                parentRect: dd.parentElement ? dd.parentElement.getBoundingClientRect() : null,
                itemCount: dd.querySelectorAll('li').length
            } : null,
            s45: {
                rect: s45Rect,
                rowDisplay: s45RowCS ? s45RowCS.display : null,
                rowFlexDirection: s45RowCS ? s45RowCS.flexDirection : null,
                cols: s45Cols,
                widgets: s45Widgets
            },
            scrollWidth: document.documentElement.scrollWidth
        };
    })()`);

    await send('Page.navigate', { url: 'http://127.0.0.1:8000/about-us' });
    await new Promise(r => setTimeout(r, 2000));

    const aboutDiag = await evalJS(`(() => {
        const sels = ['#page', '#content', '#content > .ast-container', '#primary', '#main', 'article', '.entry-header', '.entry-content', '.elementor-2835', '.elementor-2835 .elementor-section'];
        const out = {};
        for (const s of sels) {
            const el = document.querySelector(s);
            if (!el) continue;
            const cs = getComputedStyle(el);
            out[s] = {
                rect: el.getBoundingClientRect(),
                marginTop: cs.marginTop,
                marginBottom: cs.marginBottom,
                paddingTop: cs.paddingTop,
                paddingBottom: cs.paddingBottom,
                display: cs.display,
                height: cs.height
            };
        }
        return out;
    })()`);

    console.log('=== HOME DIAG ===');
    console.log(JSON.stringify(homeDiag, null, 2));
    console.log('=== ABOUT DIAG ===');
    console.log(JSON.stringify(aboutDiag, null, 2));

    ws.close();
    chrome.kill();
}

main().catch(e => { console.error(e); process.exit(1); });

