# Magento 2 Reports GraphQL / PWA

[Mageplaza Reports for Magento 2](https://www.mageplaza.com/magento-2-reports-extension/) brings efficiency and convenience for store owners to bring all your store information under their eyes. 

The extension provides intuitive and insightful reports that cover all critical data necessary for store owners to make crucial business decisions. All the critical data can be recorded from customers, orders, sales, and products, which are indispensable to understanding and measuring an online store’s operation, performance, and effectiveness. With Mageplaza reports, you can get clear pictures of all these aspects by viewing data collected in a specific period of time, such as one week, one month, and more. 

No more paper listing or a long sheet of data reporting; the reports will be displayed in a chart format. It shows your store’s data in a way more easy-to-understand and concrete. Each chart will show separate data, including repeat customer rate, order rate, totals, average order value, shipping, etc. The difference between the positive and negative status of your data will be distinguished by different colors, so you quickly get the overall result of a report.

You can customize your report dashboard from the admin backend. If you want to remove or add any type of report, drag and drop each element into your report dashboard to complete the customization in a breeze. It’s possible to adjust the sizes of report charts to fit your mind of design. 

One more remarkable feature of this module is that it allows you to create and switch to different report dashboards, such as default store view or all store views. After completing the new layout setup, you can save the layout to view next time more conveniently. 

Besides, in the new advanced reports, you will be able to access more data, including sales by location, repeat customer rate, conversion funnel, extra card report, and more in the higher versions of the extension. 

What’s more, **Magento 2 Reports GraphQL is now a part of Mageplaza Reports that adds GraphQL features and supports PWA compatibility.** 

## 1. How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-reports-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

**Note:**
Magento 2 Reports GraphQL requires installing [Mageplaza Reports](https://github.com/mageplaza/magento-2-reports) in your Magento installation. 

## 2. How to use

To start working with GraphQL in Magento 2, you need the following:
- Use Magento 2.3.x. Returns site to developer mode
- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)

Check the supported query <a href='https://documenter.getpostman.com/view/10589000/SzS1V9Fg?version=latest' target='_blank' rel='nofollow'>here</a>

## 3. Devdocs 
- [Magento 2 Reports API & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fd?version=latest)
- [Magento 2 Reports GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fg?version=latest)

Click on Run in Postman to add these collection to your workspace quickly.

![Magento 2 blog graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module
Feel free to **Fork** and contribute to this module. 

You can create a pull request, and we will merge your proposed changes in the main branch. 

## 5. Get support 
- [Contact us](https://www.mageplaza.com/contact.html) if you have any questions. If you have any problems in a certain step, feel free to let us know so our support team can help you resolve the problems quickly. 
- If you find this post helpful, please give it a **Star** ![star](https://i.imgur.com/S8e0ctO.png)


