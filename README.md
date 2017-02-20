# [![bitmovin](http://www.dacast.com/wp-content/themes/dacast/images/logo.png)](https://www.dacast.com)

The Dacast SDK for PHP is a seamless integration with the [Dacast API](https://www.dacast.com). You can use our API to access Dacast API endpoints.

# Installation
Change directory to your project folder and install with Composer.

```bash
cd your/project/folder
```

Edit your composer.json and add this
```bash
"repositories": [
    {
        "type": "vcs",
        "url":  "git@github.com:dacast/api-php.git"
    }
]
```
Then, open your terminal and paste
```bash
composer install 
```
 
# Usage

Before you can start using the api you need to **set your API key.**

Your API key can be found in the **settings of your Dacast user account**.

## Demos
* [**Live**](examples/channel)
    * [Retrieve](examples/channel/retrieve.php)
    * [Create](examples/channel/create.php)
    * [Modify](examples/channel/modify.php)
    * [Delete](examples/channel/delete.php)
    * [Upload a thumbnail](examples/channel/uploadThumbnail.php)
    * [Upload a splashscreen](examples/channel/uploadSplashscreen.php)
* [**Vod**](examples/vod)
    * [Retrieve](examples/vod/retrieve.php)
    * [Modify](examples/vod/modify.php)
    * [Delete](examples/vod/delete.php)
    * [Transcoding](examples/vod/transcodingVod.php)
    * [Upload](examples/vod/upload.php)
    * [Upload a thumbnail](examples/vod/uploadThumbnail.php)
    * [Upload a splashscreen](examples/vod/uploadSplashscreen.php)
* [**Playlist**](examples/playlist)
    * [Retrieve](examples/playlist/retrieve.php)
    * [Create](examples/playlist/create.php)
    * [Modify](examples/playlist/modify.php)
    * [Upload a thumbnail](examples/playlist/uploadThumbnail.php)
    * [Upload a splashscreen](examples/playlist/uploadSplashscreen.php)
* [**Package**](examples/package)
    * [Retrieve](examples/package/retrieve.php)
    * [Create](examples/package/create.php)
    * [Modify](examples/package/modify.php)
    * [Delete](examples/package/delete.php)
    * [Upload a thumbnail](examples/package/uploadThumbnail.php)
    * [Upload a splashscreen](examples/package/uploadSplashscreen.php)
* [**Account**](examples/account)
    * [Retrieve Sells](examples/account/sells.php)