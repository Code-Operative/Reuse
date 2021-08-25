REUSE Home was created in 2021 as a response to the COVID-19 pandemic where many reuse charities and social enterprises found themselves without an online retail outlet. REUSE Network saw a gap in the market for an e-commerce site that could provide a platform for charity shops to market and sell their products without having to open to the public. 

This software is a modified instance of PrestaShop v1.7.7.1 using the Knowband Multi-vendor Marketplace module and other modules. The reuse network has purchased licenses for the correct use of these items. Please note that this repository contains code of licenses that will need to be purchased.

If you would like more information on using this modified instance of PrestaShop, please email contact@code-operative.co.uk.

# Prestashop 
PrestaShop is a freemium, open source e-commerce platform. The software is published under the Open Software License. It is written in the PHP programming language with support for the MySQL database management system. It has a software dependency on the Symfony PHP framework. <cite>[Wikipedia][1]</cite> 

Instructions of how to install prestashop can be found in [this how to install page](https://www.prestashop.com/en/blog/how-to-install-prestashop). There are three different methods: One click install, Intstall manually and Install locally, are all described here. 

Or to download the newest version of prestashop directly go to the [download page](https://www.prestashop.com/en/download)

To download a specific version, [click here](https://www.prestashop.com/en/versions)

# Theme
The theme used in REUSE Home is the Interior - Furniture Store Template theme. To purchase and download this theme, please visit [theme page](https://addons.prestashop.com/en/home-garden-themes/24311-interior-furniture-store.html). Further customisation is then made to the theme. Most of the css customisations made can be found in `/themes/child_interior_th/assets/css`

The theme comes with a few modules:
- Wishlist 
- Colour change
- CSS Editing Module
- Blog 

# Modules Installed
The modules installed in REUSE Home are: 
- Knowband marketplace module 
  - Automatic payment
- Marketplace deal manager
- Paypal module 
- Content Box
- Postcode check module 

## Paypal Module (Free)
This module enables the buyer to purchase products using paypal and handles the buyer <-> admin transaction. Please note that the admin <-> seller part of the transaction is handled by the knowband marketplace module using the [automatic payment](#### Autotomatic payments).

The paypal module can be downloaded [here](https://addons.prestashop.com/en/payment-card-wallet/1748-paypal-official.html). 

## Content Box (Free) 
ContentBox is a very simple, very intuitive and very powerful Prestashop Module. With contentBox you can add html blocks to prestashop, JAVASCRIPT + CSS blocks anywhere you want inside Prestashop 1.5 or Prestashop 1.7. For more info [visit the site/download the module](https://contentbox.org/). ContentBox is licensed under [GNU GPL v3](https://www.gnu.org/licenses/gpl-3.0.html)

This module is used in this project mainly to add JAVASCRIPT customisations and features. The seller map feature is an example. **file to sellers map**

## Marketplace Module (Purchased)
This module hooks to prestashop default features for users/buyers and gives additional functionaliy to create their own store and sell their own products. To get more information about/how to purchase this module, please visit [here](https://www.knowband.com/prestashop-marketplace).

### Automatic Payments (Purchased)
This is a custom change that is done by knowband for REUSE Home to enable payments to be automatically done when a purchase is made by the buyer directly to the seller from the admin. By default, the seller would have to request a payout from the admin and the admin would have to approve it before the transaction between admin <-> seller can be made. It is possible to enable the payout request to be made automatically, however the admin would still need to approve it. 

This customisation enables the payout request to be approved, transaction status between admin and seller and the transaction to be done automatically. Two cron jobs are set up here to automize this process.
1) to update the status 
2) to initalize a transaction

The status is periodically checked by the first cron job 40mins. All the unsuccessful transaction will be initialized by the second cron job at 12pm daily using the [paypal payout API](https://developer.paypal.com/docs/api/payments.payouts-batch/v1/).

## Marketplace Deal Manager (Purchased) 
This module helps the sellers of the Prestashop Multi-vendor Marketplace to offer discounts and deals on their products. This module can be purchased [here](https://www.knowband.com/index.php?route=product/product&product_id=197). 

## Postcode Check Module (can be downloaded)
This module allows for sellers in the backoffice to 
1) check if an item is collection only 
2) insert a list of postcode prefix 
3) insert full postcode to calculate distance  

In the front office, the module has a form where buyer can enter their postcode to check if the product is deliverable to the inserted postcode and also for buyers to check the distance should the product be collection only (collection only is determined using a specific shipping method created by the admin and avaliable for all sellers). The logic of the module is illustrated in the diagram below. 

![The logic of postcode check module](https://user-images.githubusercontent.com/39419492/117545554-30d98000-b01e-11eb-8c20-fd3a865ba8b0.png)

The distance is calculated using google [geolocation API](https://developers.google.com/maps/documentation/geolocation/overview), an account needs to be created for their API. For more information visit the [google maps platform](https://cloud.google.com/maps-platform).

This is a module developped by [Code-Operative](https://code-operative.co.uk/) for the [prestashop marketplace](###marketplace-module) and the zip file can be downloaded from [this github repository](https://github.com/Code-Operative/Reuse/blob/master/postcodecheck.zip) and can be drag and dropped into the upload module page. 

## Advanced Search Module 

This module is to provide advanced search for buyers to:
1) search for products that are delivered to a specific postcode prefix
2) search for products that are within a certain mile of a postcode

In the front office, the module has a form that the buyer can search with keywords, postcode and miles (for collection). The result will show all products that satisfy the search criteria in the same way prestashop default search does. 

The logic of the module can be illustrated with the diagram belo: 

![The logic of advanced search module](https://user-images.githubusercontent.com/39419492/130858924-ada0747a-2956-4dd8-9ae3-499cd9d272cd.png)
The diagram can also be found in the [miroboard](https://miro.com/app/board/o9J_l0_NArk=/): 

Lat and Lon in the diagram stands for longitude and latitude respectively, they are converted from postcode using the [open source postcodes.io API service](https://postcodes.io/). 

The collection search longitude and latitude to calculate the distance and return the desired results. The delivery search compares the postcode prefix e.g. NE1 7JB would have the prefix of NE1 and return sellers that matches the postcode prefix. 

The module depends on the knowband marketplace module’s custom fields for both postcode (collection) and postcode prefix (for delivery). A new table is created to track the changes of postcode, this is done by using a trigger in the database. When the seller updates either postcode in the kbmarketplace custom fields mapping table then the trigger will raise a flag in the tracking table. When a search is made, the tracking table is checked for any updates to be made to the seller’s longitude and latitude and make them if necessary. For the buyers, when the postcode is updated a hook is triggered to update the latitude and longitude. 

The search for keywords is done using [prestashop default search](https://devdocs.prestashop.com/1.7/development/components/faceted-search/). 

This is a module developped by [Code-Operative](https://code-operative.co.uk/) to work with [prestashop marketplace](###marketplace-module). The zip file can be downloaded from [this github repository]() and can be drag and dropped into the upload module page. After installation, make sure that the following hooks are implemted: 
- actionCustomerAccountAdd
- actionCustomerAccountUpdate
- actionFrontControllerSetMedia
- displayTopColumn
- productSearchProvider


# Code Customisations 
The main code customisations are done in: 
- theme 
- JS functionality through content box 
- module overrides 

## Theme Customisation 
As mentioned in [theme section](#theme) most of the CSS can be found in the custom.js in `/themes/child_interior_th/assets/css`

## Module Overrides
All module overrides are in the child theme under their respective folders. E.g. if it's a module override then `/themes/child_interior_th/modules/`

# References
[1] [Wikipedia on prestashop](https://en.wikipedia.org/wiki/PrestaShop)
