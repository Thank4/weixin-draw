# weixin-draw
# weixin-draw
使用新浪云SAE的环境，数据库使用的mysql共享性质的数据库，数据库使用的新浪云提供的api方法，使用微信公众号开发，用户扫描来获取用户的基本信息，通过微信开发平台的提供的api事件，关注返回用户的基本信息xml数据包，然后存储到数据库中。微信中当然要获取access_token，以及缓存token的时效性，使用的memcache，应该新浪不支持对服务的文件读写，所以没用文件来保存，当时写了一个简单的封装类用于使用。微信的很多信息都是通过aceess_token来获取用户信息，抽奖界面使用了一个国人写的layui来构建前端页面，也是给予jQuery来实现的，用到的了事件的绑定以及事件的解绑等等，还有对json格式的数据的处理等的，ajax提交获取中奖信息等等，投票具有时候性，用户微信回复关键字，获取投票的url来进行投票，设计到微信网页开发的一点内容，实时性是使用的新浪当时提供的channel类似于websocket，来实现投票的，前端投票使用了ichartjs给予HTML5 canvas的图像插件来构建图标，并且提供了不错的api供使用。大体上实现了抽奖以及投票的需求。
