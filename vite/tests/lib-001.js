// https://playwright.dev/docs/library
import { chromium, devices } from 'playwright';

(async () => {
  const browser = await chromium.launch();
  // Create pages, interact with UI elements, assert values
  await browser.close();
})();