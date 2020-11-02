# Reports GraphQl

## 1. How to install
Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-reports-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

## 2. How to use

To start working with GraphQl in Magento, you need the following:
- Use Magento 2.3.x. Returns site to developer mode
- Install [chrome extension](https://chrome.google.com/webstore/detail/chromeiql/fkkiamalmpiidkljmicmjfbieiclmeij?hl=en) (currently does not support other browsers)
- Set **GraphQL endpoint** as `http://<magento2-3-server>/graphql` in url box, click **Set endpoint**. (e.g. http://develop.mageplaza.com/graphql/ce232/graphql)

## 3. Devdocs
REST API:
- [Reports Standard API & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fd?version=latest)
- [Reports Pro API & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fe?version=latest)
- [Reports Ultimate API & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Ff?version=latest)

GraphQL:
- [Reports Standard GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fg?version=latest)
- [Reports Pro GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fh?version=latest)
- [Reports Ultimate GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzS1V9Fi?version=latest)
