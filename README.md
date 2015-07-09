# Design2
---
Enhance Magento's design change system with more functionality.

## Feature Highlights

![Design2](http://blog.rickbuczynski.com/wp-content/uploads/2015/07/blur2.jpg)

* Apply multiple design changes simultaneously
* Name, enable, and disable changes
* Apply to specific pages by route
* Use custom layout XML updates
* Append, prepend custom HTML content to pages

## Description
Design2 is an enhancement to Magento's native _Design_ system. By default, you can 
manage changes via *System > Design*. Design2 takes this feature and adds more 
flexibility, with the purpose of empowering administrators to make on-the-fly
adjustments to pages without major re-working of code.

## Use Cases
Design2 gives you control over pages in the same way as with product management.
The benefit here, though, is that you're not limited to the PDP. Instead, if you
know the route, then you can target the page. Here are some use cases:

* Adding tracking pixels on the checkout success page
* Adding temporary announcements
* A/B testing content changes
* Any time you don't want to edit local.xml or a template

## Screenshots
![Design2](http://blog.rickbuczynski.com/wp-content/uploads/2015/07/Edit_Design_Change___Design___System___Magento_Admin-e1436450261650.jpg)

![Design2](http://blog.rickbuczynski.com/wp-content/uploads/2015/07/Edit_Design_Change___Design___System___Magento_Admin-2-e1436450273228.jpg)

![Design2](http://blog.rickbuczynski.com/wp-content/uploads/2015/07/Disc_Store-e1436450292464.jpg)

## Installation
With modman,

```
modman clone https://github.com/vbuck/mage-design2.git
modman deploy mage-design2
```

Or with Composer,

```
{
    "require" : {
        "vbuck/mage-modal" : "*"
    },
    "repositories" : [
        {
            "type" : "vcs",
            "url"  : "https://github.com/vbuck/mage-design2.git"
        }
    ]
}
```

Or else manually extract a GitHub archive contents to your project root.
