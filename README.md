# Magento 2 Reports GraphQL (Support PWA)

## How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-reports-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## How to use

To start working with GraphQL in Magento 2, you need the following:
- Use Magento 2.3.x. Returns site to developer mode
- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)

Check the supported query <a href='https://documenter.getpostman.com/view/10589000/SzS1V9Fg?version=latest' target='_blank' rel='nofollow'>here</a>
