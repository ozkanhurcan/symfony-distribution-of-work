# Distribution of Work Challenge

- If you have symfony binary installed;
```bash
$ git clone https://github.com/ozkanhurcan/symfony-distribution-of-work.git
$ composer install
$ symfony:start
```


- webpack installation and zipping 
```bash
$ composer require symfony/webpack-encore-bundle

$ yarn add --dev @symfony/webpack-encore

$ yarn add webpack-notifier@^1.6.0 --dev

$ yarn add sass-loader@^8.0.0 node-sass --dev

$ yarn encore dev
```

# Pages

```url
http://127.0.0.1:8000/employee/create
```
- Which is you can create employee
```url
http://127.0.0.1:8000/employee/list
```
- Which is you can list employee
```url
http://127.0.0.1:8000/get-work-list/create
```
- I can't configurate dcotrine with commandController files so I create this page to add works data from given API

```url
http://127.0.0.1:8000/works/list
```
- This page is showing developers job week by week with algorithm

# Command
```bash
$ php bin/console app:save-works
```
- It's just says 'Hi!' 
