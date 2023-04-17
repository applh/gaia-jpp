// https://playwright.dev/docs/library
import { chromium, devices } from 'playwright';

// (async () => {
//   const browser = await chromium.launch();
//   // Create pages, interact with UI elements, assert values
//   await browser.close();
// })();

async function shot ()
{
  const browser = await chromium.launch();
  const page = await browser.newPage();
  await page.goto('https://playwright.dev/');
  await page.screenshot({ path: `my-example.png` });
  await browser.close();
}

shot();

