<p align="center">
  <a href="https://vuravel.com" target="_blank">
    <img src="https://vuravel.com/img/vuravel-logo-big.png" width="200" height="133" alt="Vuravel-logo" />
  </a>
</p>
<h6 align="center">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/vuravel/components.svg">
    <img src="https://img.shields.io/npm/dt/vuravel-components.svg?style=flat-square" alt="Downloads" />
    <img src="https://img.shields.io/npm/v/vuravel-components.svg?style=flat-square" alt="Version" />
    <img src="https://img.shields.io/npm/l/vuravel-components.svg?style=flat-square" alt="License" />
</h6>
<h3 align="center">
    <a href="https://vuravel.com" target="_blank">vuravel.com</a>
    &nbsp;&nbsp;&bull;&nbsp;&nbsp;
    <a href="https://vuravel.com/docs" target="_blank">Documentation</a>
    &nbsp;&nbsp;&bull;&nbsp;&nbsp;
    <a href="https://vuravel.com/examples" target="_blank">Demos</a>
    &nbsp;&nbsp;&bull;&nbsp;&nbsp;
    <a href="https://twitter.com/vuravel" target="_blank">Twitter</a>
</h3>

# vuravel/components

`vuravel\components` is a library of components to help you write forms in a matter of seconds. No matter how complex the user input you need, you can find a component that handles that. You can also pick from different styles to suit your needs.

> Refer to the the website for the most up-to-date information, demos and the complete detailed documentation on how to use this package: <a href="https://vuravel.com">vuravel.com</a>


## REQUIREMENTS

You need to have a `Laravel 5.6+` application installed on your local server.  
You need `composer` to pull the vendor packages.  
`Vue.js 2.0+` is already shipped with a Laravel installation, so nothing to do here.  
`Node.js` & `npm` to build and pull the Front-End modules.  

## INSTALLATION

#### Composer - Back-End setup

If you have a Laravel 5.6+ application installed, you may install `vuravel/form` via `composer` by running the following terminal command at your project's root folder:

```sh
composer require vuravel/form
```

<b>Optional step (recommended)</b> - if you wish to store file uploads in a separate `medias` table or addresses in a `places` table, you can leverage already built migrations from vuravel:

```sh
php artisan migrate
```

#### Npm - Front-End setup

To pull the front-end module into your development environment, you will need to have `nodejs` and `npm` installed on your machine. Then you may run this command:

```sh
npm install --save vuravel-form
```

Once the install process is finished, you should import the javascript modules in your `app.js` . This will import all the Vue components from `vuravel/form` into your project and you will be able to use them everywhere in your Vue.js code.

```js
//in your app.js, after window.Vue = require('vue');
import VuravelForm from 'vuravel-form';
Vue.use(VuravelForm);
```

And to import the scss code, add this line to your `app.scss` :

```js
//in your app.scss 
@import '~vuravel-form/sass/form-style-floating';
// or if you prefer another style:
// @import '~vuravel-form/sass/form-style-bootstrap';
```

After that just compile the assets and you are all set!

```sh
npm run dev
```

## DOCUMENTATION

Please refer to the website's complete <a href="https://vuravel.com/docs" target="_blank">Documentation</a>

## DEMOS

<a href="https://vuravel.com/examples" target="_blank">Examples (interactive)</a>