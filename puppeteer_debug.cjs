const puppeteer = require('puppeteer');

(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    page.on('console', msg => console.log('PAGE LOG:', msg.text()));
    page.on('pageerror', error => console.log('PAGE ERROR:', error.message));
    page.on('requestfailed', request => console.log('REQUEST FAILED:', request.url(), request.failure().errorText));

    console.log('Navigating to login...');
    await page.goto('http://127.0.0.1:8000/login');
    
    // Login
    await page.type('#email', 'admin@mirage.com');
    await page.type('#password', 'password');
    await Promise.all([
        page.click('button[type="submit"]'),
        page.waitForNavigation({ waitUntil: 'networkidle0' }),
    ]);

    console.log('Navigating to Carriers...');
    await page.goto('http://127.0.0.1:8000/admin/carriers', { waitUntil: 'networkidle0' });

    console.log('Navigating to Zones...');
    await page.goto('http://127.0.0.1:8000/admin/zones', { waitUntil: 'networkidle0' });

    await browser.close();
})();
