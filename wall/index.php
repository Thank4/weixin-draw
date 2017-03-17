<?php
if($_GET['code']!=md5('2017newyear')) {
    exit('ERROR:非法访问');
}
require_once 'functions.php';
$mysql=new SaeMysql();
$sql="SELECT * FROM userinfo ORDER BY subscribe_time DESC";
$data=$mysql->getData($sql);
?>
<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>2016年太湖国际微盘年会</title>
    <meta name="keywords" content="2016太湖国际年会">
    <meta name="description" content="2016太湖国际年会">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- 设计：Sww18 重构:Sww18 Blog:www.thank4.cn-->
    <script src="js/jquery-1.3.2.min.js"></script>
    <script src="js/jquery.kxbdmarquee.js"></script>
    <!-- 引入 Particleground.js -->
    <script src="js/particleground.all.js"></script>
    <!-- 引入 粒子特效js -->
    <script src="js/particle.js"></script>
    <!-- 引入ichartjs-->
    <script src='http://www.ichartjs.com/ichart.latest.min.js'></script>
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" href="../layui/css/layui.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body style="overflow-y:hidden">
<section class="bg"></section>
<!--header part-->
<div class="header">
    <div class="header-center">
        <div class="header-title">
            <p class="WallTitle">2016太湖国际微盘年会，扫描右侧二维码立即加入</p>
            <p class="count">现有共<span class="countNow"><?php echo count($data); ?></span>人加入</p>
        </div>
        <div class="header-img" >
            <img src="img/0.jpg" width="80" height="80">
        </div>
    </div>
</div>

<!--header end-->

<!-- Wall Part -->
<div class="WeiWall" >
    <div class="marquee">
        <ul id="WallContent">
            <?php
            if($data){
                foreach ($data as $v){
                    ?>
                    <li>
                        <div class="useinfo"><img class="layui-circle" src="<?php echo $v['headimgurl']?>" width="70" height="70">
                            <p class="w_name"><?php echo $v['nickname']?></p></div>
                        <span  class="w_city">来自:<?php if(!empty($v['city'])){ echo $v['city']; }else{ echo '未知地区';} ?></span>
                        <span class="w_time"><?php echo timespan($v['subscribe_time'],time()) ?>前加入</span><hr class="hr1"></li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
<!-- Wall Part end-->

<!--  Draw Part-->
<div class="WeiDraw" style="display: none">
    <div class="DrawLeft shadow">
        <div>
            <span class="layui-btn layui-btn-small layui-btn-danger startData" style="display: none">初始化数据</span>
        </div>
        <form class="layui-form" action="">
            <!--奖项选择-->
            <div class="layui-form-item">
                <label class="layui-form-label">奖项选择</label>
                <div class="layui-input-block">
                    <select  name="interest" lay-filter="prize" >
                        <option value=""></option>
                        <option value="-1" selected="">--奖项选择--</option>
                        <option value="0">特等奖</option>
                        <option value="1">一等奖</option>
                        <option value="2">二等奖</option>
                        <option value="3">三等奖</option>
                        <option value="4">四等奖</option>
                    </select>
                    <!-- 隐藏浮层-->
                    <div class="hidePrize layui-disabled" style="display: none"></div>
                </div>

            </div>

            <!--奖品内容-->
            <div class="layui-form-item prize-content"  style="display: none">
                <label class="layui-form-label">奖品内容</label>
                <div class="layui-input-block">
                    <input type="text" name="title" lay-verify="title" autocomplete="off"  class="layui-input prize-value" value="iPhone7" disabled>
                </div>
            </div>

            <!--选择人数-->
            <div class="layui-form-item prizePerson" style="display: none">
                <label class="layui-form-label">中奖人数</label>
                <div class="layui-input-block">
                    <select  name="interest" lay-filter="prizeNum" class="drawNum">
                        <option value=""></option>
                        <option value="0" selected="">--中奖人数--</option>
                        <option value="1">1人</option>
                        <option value="3">3人</option>
                        <option value="5">5人</option>
                    </select>
                    <!-- 隐藏浮层-->
                    <div class="hideNum layui-disabled" style="display: none"></div>
                </div>
            </div>
            <!--提交-->
            <input type="button" class="layui-btn layui-btn-small startBtn" value="开始抽奖">
            <input type="button" class="stopBtn layui-btn layui-btn-danger layui-btn-small " value="结束滚动" style="display: none">
        </form>
    </div>
    <div class="DrawRight shadow" style="display: none">
        <!-- 1人 -->
        <div class="DrawOne" style="display: none">
            <div class="center"><p style="text-align: center">获奖者</p></div>
            <div class="DrawOneImg">
                <!--                <img src="./img/headbg.png" width="140" height="194" style="position: relative" >-->
                <img class="layui-circle oneImg" src="./img/headDefault.png" width="140" height="140" >
            </div>
            <div class="layui-btn layui-btn-mini DrawName oneDraw" openid="null">求中奖</div>

        </div>
        <!-- 3人 -->
        <div class="DrawThree" style="display: none">
            <div class="DrawThreeList">
                <div class="center"><p style="text-align: center">获奖者①</p></div>
                <div class="DrawOneImg">
                    <img  class="layui-circle" src="./img/headDefault.png" width="140" height="140">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖①</div>
            </div>
            <div class="DrawThreeList">
                <div class="center"><p style="text-align: center">获奖者②</p></div>
                <div class="DrawOneImg">
                    <img class="layui-circle" src="./img/headDefault.png" width="140" height="140">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖②</div>
            </div>
            <div class="DrawThreeList">
                <div class="center"><p style="text-align: center"><p style="text-align: center">获奖者③</p></div>
                <div class="DrawOneImg">
                    <img class="layui-circle" src="./img/headDefault.png" width="140" height="140">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖③</div>
            </div>
        </div>
        <!-- 5人 -->
        <div class="DrawFive" style="display: none">
            <div class="DrawFiveList">
                <div class="center"><p style="text-align: center">获奖者①</p></div>
                <div class="DrawOneImg">
                    <img  class="layui-circle" src="./img/headDefault.png" width="140" height="140"">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖①</div>
            </div>
            <div class="DrawFiveList">
                <div class="center"><p style="text-align: center">获奖者②</p></div>
                <div class="DrawOneImg">
                    <img  class="layui-circle" src="./img/headDefault.png" width="140" height="140"">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖②</div>
            </div>
            <div class="DrawFiveList">
                <div class="center"><p style="text-align: center">获奖者③</p></div>
                <div class="DrawOneImg">
                    <img  class="layui-circle" src="./img/headDefault.png" width="140" height="140"">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖③</div>
            </div>
            <div class="DrawFiveList">
                <div class="center"><p style="text-align: center">获奖者④</p></div>
                <div class="DrawOneImg">
                    <img  class="layui-circle" src="./img/headDefault.png" width="140" height="140"">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖④</div>
            </div>
            <div class="DrawFiveList">
                <div class="center"><p style="text-align: center">获奖者⑤</p></div>
                <div class="DrawOneImg">
                    <img  class="layui-circle" src="./img/headDefault.png" width="140" height="140"">
                </div>
                <div class="layui-btn layui-btn-mini DrawName" openid="null">求中奖⑤</div>
            </div>
        </div>

    </div>
</div>
<!-- Draw end-->

<!-- Vote Part -->
<div class="WeiVote" style="display: none">
    <div id='ichart-render'></div>
</div>
<!-- Vote end -->


<!-- controller -->
<div class="controller-menu">
    <div class="controller-close">+</div>
    <div class="controller-button">
        <a class="btn-menu btnSkin" ></a>
        <a class="btn-menu btnWall" ></a>
        <a class="btn-menu btnDraw" ></a>
        <a class="btn-menu btnVote" ></a>
        <a class="btn-menu btnScreen" ></a>
    </div>
</div>

<div class="controller-open">+</div>

<!-- controller end-->


<!--数据存放-->

<div class="allData" style="display: none">
    <?php

    if($data){
        echo json_encode($data);
    }
    ?>
</div>
<script>
    (function(){
        $(".marquee").kxbdMarquee({direction:"up",loop:0});
    })();
</script>
<script src="../layui/layui.js"></script>
<script>
    //外层组件先加载
    layui.use(['layer', 'form', 'element','jquery'], function(){
        var layer = layui.layer
            ,form = layui.form()
            ,element = layui.element();

        var $ = layui.jquery //重点处
            ,layer = layui.layer;
        //jquery代码

        // 实时获取数据

        getTest();
        function getTest(){
            $.post("ajax/data.php",function(data){
                var arr=data.split("-*#");
                $("#WallContent").html(arr[0]);
                $(".countNow").html(arr[1]);
            });
            setTimeout(getTest,5000);
        }


    //换肤
    $(".btnSkin").click(function(){
        layer.open({
            type: 1,
            title: '换肤',
            closeBtn: 1
            ,
            shadeClose: true,
            skin: 'layui-layer-molv',
            area: ['400px', '240px'], //宽高
            content: '<div class="chooseContainer"><div class="chooseStyle sht1"><div class="chooseImg cm1"><img src="img/snow.png" width="100" height="80"></div><div class="chooseF"><p style="text-align: center">下雪场景</p></div></div>' +
            '<div class="chooseStyle sht2"><div class="chooseImg cm2"><img src="img/line.png" width="100" height="80"><div><div class="chooseF"><p style="text-align: center">科幻线条</p></div></div></div>'
        });
        //
        $(".sht1").click(function(){
            $(this).css({"border":"3px solid #009f95","background":"url(img/checked.png) no-repeat bottom right","color":" #009f95"});
            $(".sht2").css({"border":"3px solid rgba(128, 128, 128, 0.6)","background":"none","color":"#808080"});
            new Particleground.snow('.bg');
        });

        $(".sht2").click(function(){
            $(this).css({"border":"3px solid #009f95","background":"url(img/checked.png) no-repeat bottom right","color":" #009f95"});
            $(".sht1").css({"border":"3px solid rgba(128, 128, 128, 0.6)","background":"none","color":"#808080"});
            new Particleground.particle('.bg');
        });
    });

    /** hover tips **/
    $(".startData").hover(function(){
        layer.tips('整体抽奖过程中仅点击执行一次初始化，切勿多次点击','.startData',{
            tips: [1, '#3595CC'],
            time: 6000
        });
    },function(){
        layer.closeAll('tips');
    });
    $(".btnSkin").hover(function(){
        layer.tips('换肤','.btnSkin',{
            tips: [1, '#3595CC'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });

    $(".btnWall").hover(function(){
        layer.tips('微信墙','.btnWall',{
            tips: [1, '#3595CC'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });

    $(".btnDraw").hover(function(){
        layer.tips('抽奖','.btnDraw',{
            tips: [1, '#3595CC'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });
    $(".btnVote").hover(function(){
        layer.tips('投票','.btnVote',{
            tips: [1, '#3595CC'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });


    /** hover tips  end**/

    var wxDraw=$(".WeiDraw");
    var wxWall=$(".WeiWall");
    var wxVote=$(".WeiVote");
    //
    $(".btnWall").click(function(){
        wxWall.show();
        wxDraw.hide();
        wxVote.hide();
    });

    $(".btnDraw").click(function(){
        var music=document.getElementById('Dmusic');
        wxDraw.show();
        wxWall.hide();
        wxVote.hide();
    });

    $(".btnVote").click(function(){
        wxVote.show();
        wxDraw.hide();
        wxWall.hide();

    });


    //全屏
    var Screen=$(".btnScreen");
    Screen.hover(function(){
        layer.tips('全屏','.btnScreen',{
            tips: [1, '#3595CC'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });

    Screen.click(function(){
        launchFullScreen(document.documentElement);
    });

    // 判断各种浏览器，找到正确的方法
    function launchFullScreen(element) {
        if(element.requestFullscreen) {
            element.requestFullscreen();
        } else if(element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if(element.webkitRequestFullscreen) {
            element.webkitRequestFullscreen();
        } else if(element.msRequestFullscreen) {
            element.msRequestFullscreen();
        }
    }

    //关闭菜单
    $(".controller-close").click(function(){
        $(".controller-menu").hide(1000);
        $(".controller-open").show(2000);
    });

    //关闭tips
    $(".controller-close").hover(function(){
        layer.tips('关闭功能性菜单','.controller-close',{
            tips: [4, '#000'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });

    //开启
    $(".controller-open").click(function(){
        $(".controller-menu").show(1000);
        $(".controller-open").hide(1000);
    });

    $(".controller-open").hover(function(){
        layer.tips('开启功能性菜单','.controller-open',{
            tips: [4, '#000'],
            time: 4000
        });
    },function(){
        layer.closeAll('tips');
    });


    var hexcase=0;function hex_md5(a){ if(a=="") return a; return rstr2hex(rstr_md5(str2rstr_utf8(a)))}function hex_hmac_md5(a,b){return rstr2hex(rstr_hmac_md5(str2rstr_utf8(a),str2rstr_utf8(b)))}function md5_vm_test(){return hex_md5("abc").toLowerCase()=="900150983cd24fb0d6963f7d28e17f72"}function rstr_md5(a){return binl2rstr(binl_md5(rstr2binl(a),a.length*8))}function rstr_hmac_md5(c,f){var e=rstr2binl(c);if(e.length>16){e=binl_md5(e,c.length*8)}var a=Array(16),d=Array(16);for(var b=0;b<16;b++){a[b]=e[b]^909522486;d[b]=e[b]^1549556828}var g=binl_md5(a.concat(rstr2binl(f)),512+f.length*8);return binl2rstr(binl_md5(d.concat(g),512+128))}function rstr2hex(c){try{hexcase}catch(g){hexcase=0}var f=hexcase?"0123456789ABCDEF":"0123456789abcdef";var b="";var a;for(var d=0;d<c.length;d++){a=c.charCodeAt(d);b+=f.charAt((a>>>4)&15)+f.charAt(a&15)}return b}function str2rstr_utf8(c){var b="";var d=-1;var a,e;while(++d<c.length){a=c.charCodeAt(d);e=d+1<c.length?c.charCodeAt(d+1):0;if(55296<=a&&a<=56319&&56320<=e&&e<=57343){a=65536+((a&1023)<<10)+(e&1023);d++}if(a<=127){b+=String.fromCharCode(a)}else{if(a<=2047){b+=String.fromCharCode(192|((a>>>6)&31),128|(a&63))}else{if(a<=65535){b+=String.fromCharCode(224|((a>>>12)&15),128|((a>>>6)&63),128|(a&63))}else{if(a<=2097151){b+=String.fromCharCode(240|((a>>>18)&7),128|((a>>>12)&63),128|((a>>>6)&63),128|(a&63))}}}}}return b}function rstr2binl(b){var a=Array(b.length>>2);for(var c=0;c<a.length;c++){a[c]=0}for(var c=0;c<b.length*8;c+=8){a[c>>5]|=(b.charCodeAt(c/8)&255)<<(c%32)}return a}function binl2rstr(b){var a="";for(var c=0;c<b.length*32;c+=8){a+=String.fromCharCode((b[c>>5]>>>(c%32))&255)}return a}function binl_md5(p,k){p[k>>5]|=128<<((k)%32);p[(((k+64)>>>9)<<4)+14]=k;var o=1732584193;var n=-271733879;var m=-1732584194;var l=271733878;for(var g=0;g<p.length;g+=16){var j=o;var h=n;var f=m;var e=l;o=md5_ff(o,n,m,l,p[g+0],7,-680876936);l=md5_ff(l,o,n,m,p[g+1],12,-389564586);m=md5_ff(m,l,o,n,p[g+2],17,606105819);n=md5_ff(n,m,l,o,p[g+3],22,-1044525330);o=md5_ff(o,n,m,l,p[g+4],7,-176418897);l=md5_ff(l,o,n,m,p[g+5],12,1200080426);m=md5_ff(m,l,o,n,p[g+6],17,-1473231341);n=md5_ff(n,m,l,o,p[g+7],22,-45705983);o=md5_ff(o,n,m,l,p[g+8],7,1770035416);l=md5_ff(l,o,n,m,p[g+9],12,-1958414417);m=md5_ff(m,l,o,n,p[g+10],17,-42063);n=md5_ff(n,m,l,o,p[g+11],22,-1990404162);o=md5_ff(o,n,m,l,p[g+12],7,1804603682);l=md5_ff(l,o,n,m,p[g+13],12,-40341101);m=md5_ff(m,l,o,n,p[g+14],17,-1502002290);n=md5_ff(n,m,l,o,p[g+15],22,1236535329);o=md5_gg(o,n,m,l,p[g+1],5,-165796510);l=md5_gg(l,o,n,m,p[g+6],9,-1069501632);m=md5_gg(m,l,o,n,p[g+11],14,643717713);n=md5_gg(n,m,l,o,p[g+0],20,-373897302);o=md5_gg(o,n,m,l,p[g+5],5,-701558691);l=md5_gg(l,o,n,m,p[g+10],9,38016083);m=md5_gg(m,l,o,n,p[g+15],14,-660478335);n=md5_gg(n,m,l,o,p[g+4],20,-405537848);o=md5_gg(o,n,m,l,p[g+9],5,568446438);l=md5_gg(l,o,n,m,p[g+14],9,-1019803690);m=md5_gg(m,l,o,n,p[g+3],14,-187363961);n=md5_gg(n,m,l,o,p[g+8],20,1163531501);o=md5_gg(o,n,m,l,p[g+13],5,-1444681467);l=md5_gg(l,o,n,m,p[g+2],9,-51403784);m=md5_gg(m,l,o,n,p[g+7],14,1735328473);n=md5_gg(n,m,l,o,p[g+12],20,-1926607734);o=md5_hh(o,n,m,l,p[g+5],4,-378558);l=md5_hh(l,o,n,m,p[g+8],11,-2022574463);m=md5_hh(m,l,o,n,p[g+11],16,1839030562);n=md5_hh(n,m,l,o,p[g+14],23,-35309556);o=md5_hh(o,n,m,l,p[g+1],4,-1530992060);l=md5_hh(l,o,n,m,p[g+4],11,1272893353);m=md5_hh(m,l,o,n,p[g+7],16,-155497632);n=md5_hh(n,m,l,o,p[g+10],23,-1094730640);o=md5_hh(o,n,m,l,p[g+13],4,681279174);l=md5_hh(l,o,n,m,p[g+0],11,-358537222);m=md5_hh(m,l,o,n,p[g+3],16,-722521979);n=md5_hh(n,m,l,o,p[g+6],23,76029189);o=md5_hh(o,n,m,l,p[g+9],4,-640364487);l=md5_hh(l,o,n,m,p[g+12],11,-421815835);m=md5_hh(m,l,o,n,p[g+15],16,530742520);n=md5_hh(n,m,l,o,p[g+2],23,-995338651);o=md5_ii(o,n,m,l,p[g+0],6,-198630844);l=md5_ii(l,o,n,m,p[g+7],10,1126891415);m=md5_ii(m,l,o,n,p[g+14],15,-1416354905);n=md5_ii(n,m,l,o,p[g+5],21,-57434055);o=md5_ii(o,n,m,l,p[g+12],6,1700485571);l=md5_ii(l,o,n,m,p[g+3],10,-1894986606);m=md5_ii(m,l,o,n,p[g+10],15,-1051523);n=md5_ii(n,m,l,o,p[g+1],21,-2054922799);o=md5_ii(o,n,m,l,p[g+8],6,1873313359);l=md5_ii(l,o,n,m,p[g+15],10,-30611744);m=md5_ii(m,l,o,n,p[g+6],15,-1560198380);n=md5_ii(n,m,l,o,p[g+13],21,1309151649);o=md5_ii(o,n,m,l,p[g+4],6,-145523070);l=md5_ii(l,o,n,m,p[g+11],10,-1120210379);m=md5_ii(m,l,o,n,p[g+2],15,718787259);n=md5_ii(n,m,l,o,p[g+9],21,-343485551);o=safe_add(o,j);n=safe_add(n,h);m=safe_add(m,f);l=safe_add(l,e)}return Array(o,n,m,l)}function md5_cmn(h,e,d,c,g,f){return safe_add(bit_rol(safe_add(safe_add(e,h),safe_add(c,f)),g),d)}function md5_ff(g,f,k,j,e,i,h){return md5_cmn((f&k)|((~f)&j),g,f,e,i,h)}function md5_gg(g,f,k,j,e,i,h){return md5_cmn((f&j)|(k&(~j)),g,f,e,i,h)}function md5_hh(g,f,k,j,e,i,h){return md5_cmn(f^k^j,g,f,e,i,h)}function md5_ii(g,f,k,j,e,i,h){return md5_cmn(k^(f|(~j)),g,f,e,i,h)}function safe_add(a,d){var c=(a&65535)+(d&65535);var b=(a>>16)+(d>>16)+(c>>16);return(b<<16)|(c&65535)}function bit_rol(a,b){return(a<<b)|(a>>>(32-b))};
    //初始化
    $(".startData").click(function(){
        $.ajax({
            type:'POST',
            url:'result.php',
            cache:false,
            data:{
                token:hex_md5('draw')
            },
            success:function(response,status,xhr){
                if(status=='success'){
                    layer.msg('初始化数据成功');
                }

            },
            error:function(){
                layer.alert('网络繁忙，请重新初始化');
            }
        })
    });

    /**   下拉监听  **/
    form.on('select(prize)', function(data){
        var content=$(".prize-content");      //奖项类别
        var prizeValue=$(".prize-value")[0];  //奖品内容
        var prizePerson=$(".prizePerson");    //获奖人数
        var startData=$(".startData");        //初始化数据
        function show(){content.show(100)}
        function showP(){prizePerson.show(100)}
        function showD() {startData.show(100)}
        switch (parseInt(data.value)){
            case -1:
                startData.hide();
                content.hide();
                prizePerson.hide();
                $(".DrawRight").hide();
                break;
            case 0:
                show();
                showP();
                showD();
                prizeValue.value='苹果笔记本';
                break;
            case 1:
                show();
                showP();
                showD();
                prizeValue.value='小米平衡车或扫地机器人';
                break;
            case 2:
                show();
                showP();
                showD();
                prizeValue.value='太湖蚕丝被';
                break;
            case 3:
                show();
                showP();
                showD();
                prizeValue.value='象印保温壶';
                break;
            case 4:
                show();
                showP();
                showD();
                prizeValue.value='三只松鼠坚果礼包';
                break;

        }

        //禁用select
        function selectDisabled(){
            $(".hidePrize").show();
            $(".hideNum").show();
        }

        //开启
        function selectEnabled(){
            $(".hidePrize").hide();
            $(".hideNum").hide();

        }

        //change bg
        function getArrayItems(arr, num) {
            //新建一个数组,将传入的数组复制过来,用于运算,而不要直接操作传入的数组;
            var temp_array = new Array();
            for (var index in arr) {
                temp_array.push(arr[index]);
            }
            //取出的数值项,保存在此数组
            var return_array = new Array();
            for (var i = 0; i<num; i++) {
                //判断如果数组还有可以取出的元素,以防下标越界
                if (temp_array.length>0) {
                    //在数组中产生一个随机索引
                    var arrIndex = Math.floor(Math.random()*temp_array.length);
                    //将此随机索引的对应的数组元素值复制出来
                    return_array[i] = temp_array[arrIndex];
                    //然后删掉此索引的数组元素,这时候temp_array变为新的数组
                    temp_array.splice(arrIndex, 1);
                } else {
                    //数组中数据项取完后,退出循环,比如数组本来只有10项,但要求取出20项.
                    break;
                }
            }
            return return_array;
        }
        function chooseOne() {
            var json=$(".allData").text();
            var arr=JSON.parse(json);
            var n = Math.floor(Math.random() * arr.length + 1)-1;
            $(".oneImg").attr("src",arr[n]['headimgurl']);
            $(".oneDraw").text(arr[n]['nickname']);
        }

        function chooseThree(){
            var json=$(".allData").text();
            var arr=JSON.parse(json);
            var a=$(".DrawThree").children("div").eq(0);
            var b=$(".DrawThree").children("div").eq(1);
            var c=$(".DrawThree").children("div").eq(2);
            var arr1=getArrayItems(arr,3)[0];
            var arr2=getArrayItems(arr,3)[1];
            var arr3=getArrayItems(arr,3)[2];
            a.find("img").attr("src", arr1['headimgurl']);
            b.find("img").attr("src", arr2['headimgurl']);
            c.find("img").attr("src", arr3['headimgurl']);
            a.children("div").eq(2).text( arr1['nickname']);
            b.children("div").eq(2).text( arr2['nickname']);
            c.children("div").eq(2).text( arr3['nickname']);
        }

        function chooseFive(){
            var json=$(".allData").text();
            var arr=JSON.parse(json);
            var a=$(".DrawFive").children("div").eq(0);
            var b=$(".DrawFive").children("div").eq(1);
            var c=$(".DrawFive").children("div").eq(2);
            var d=$(".DrawFive").children("div").eq(3);
            var e=$(".DrawFive").children("div").eq(4);
            var arr1=getArrayItems(arr,5)[0];
            var arr2=getArrayItems(arr,5)[1];
            var arr3=getArrayItems(arr,5)[2];
            var arr4=getArrayItems(arr,5)[3];
            var arr5=getArrayItems(arr,5)[4];
            a.find("img").attr("src", arr1['headimgurl']);
            b.find("img").attr("src", arr2['headimgurl']);
            c.find("img").attr("src", arr3['headimgurl']);
            d.find("img").attr("src", arr4['headimgurl']);
            e.find("img").attr("src", arr5['headimgurl']);
            a.children("div").eq(2).text( arr1['nickname']);
            b.children("div").eq(2).text( arr2['nickname']);
            c.children("div").eq(2).text( arr3['nickname']);
            d.children("div").eq(2).text( arr4['nickname']);
            e.children("div").eq(2).text( arr5['nickname']);
        }

        //default style
        function defaultStyleOne(){
            $(".oneImg").attr("src","http://wxdraw.applinzi.com/wall/img/headDefault.png");
            $(".oneDraw").text("求中奖");
            $(".oneDraw").attr("openid","null");
        }
        function defaultStyleThree(){
            var a=$(".DrawThree").children("div").eq(0);
            var b=$(".DrawThree").children("div").eq(1);
            var c=$(".DrawThree").children("div").eq(2);
            a.find("img").attr("src", "http://wxdraw.applinzi.com/wall/img/headDefault.png");
            b.find("img").attr("src","http://wxdraw.applinzi.com/wall/img/headDefault.png");
            c.find("img").attr("src", "http://wxdraw.applinzi.com/wall/img/headDefault.png");
            a.children("div").eq(2).text('求中奖①');
            b.children("div").eq(2).text('求中奖②');
            c.children("div").eq(2).text('求中奖③');
            a.children("div").eq(2).attr("openid","null");
            b.children("div").eq(2).attr("openid","null");
            c.children("div").eq(2).attr("openid","null");
        }
        function defaultStyleFive(){
            var a=$(".DrawFive").children("div").eq(0);
            var b=$(".DrawFive").children("div").eq(1);
            var c=$(".DrawFive").children("div").eq(2);
            var d=$(".DrawFive").children("div").eq(3);
            var e=$(".DrawFive").children("div").eq(4);
            a.find("img").attr("src", "http://wxdraw.applinzi.com/wall/img/headDefault.png");
            b.find("img").attr("src","http://wxdraw.applinzi.com/wall/img/headDefault.png");
            c.find("img").attr("src", "http://wxdraw.applinzi.com/wall/img/headDefault.png");
            d.find("img").attr("src", "http://wxdraw.applinzi.com/wall/img/headDefault.png");
            e.find("img").attr("src", "http://wxdraw.applinzi.com/wall/img/headDefault.png");
            a.children("div").eq(2).text('求中奖①');
            b.children("div").eq(2).text('求中奖②');
            c.children("div").eq(2).text('求中奖③');
            d.children("div").eq(2).text('求中奖④');
            e.children("div").eq(2).text('求中奖⑤');
            a.children("div").eq(2).attr("openid","null");
            b.children("div").eq(2).attr("openid","null");
            c.children("div").eq(2).attr("openid","null");
            d.children("div").eq(2).attr("openid","null");
            e.children("div").eq(2).attr("openid","null");
        }


        //中奖人数下拉监听
        form.on('select(prizeNum)',function(data){
            var DrawRight=$(".DrawRight");
            var DrawOne= $(".DrawOne");
            var DrawThree=$(".DrawThree");
            var DrawFive=$(".DrawFive");
            switch (parseInt(data.value)){
                case 0:
                    DrawRight.hide(200);
                    break;
                case 1:
                    DrawRight.show(200);
                    DrawOne.show(200);
                    DrawThree.hide(200);
                    DrawFive.hide(200);
                    layer.msg('选取中奖人数为一人');
                    defaultStyleOne();
                    $(".startBtn").attr("id","btnOne");
                    $(".stopBtn").attr("id","StopOne");
                    $(".startBtn").unbind('click');
                function fn1(){
                    $(".startBtn").hide();
                    $(".stopBtn").show();
                    $(".stopBtn").css("margin-left","110px");
                    window.timer0=setInterval(chooseOne,50);
                    selectDisabled();
                }
                function fn2(){
                    $(".stopBtn").hide();
                    $(".startBtn").show();
                    selectEnabled();
                }
                    $("#btnOne").click(function(){fn1();});
                    $(".stopBtn").unbind('click');
                    $(".stopBtn").click(function(){
                        fn2();
                        $.ajax({
                            type:'POST',
                            url:'get.php',
                            data:{
                                value:1
                            },
                            success:function(response,status,xhr){
                                if(status=='success'){
                                    var info=JSON.parse(response);
                                    $(".oneImg").attr("src",info[0][5]);
                                    $(".oneDraw").text(info[0][2]);
                                    $(".oneDraw").attr("openid",hex_md5(info[0][1]));
                                    clearInterval(window.timer0);
                                    layer.alert('恭喜'+info[0][2]+'获奖！',{
                                        skin: 'layui-layer-molv', //样式类名
                                        title:'中奖信息',
                                        anim: Math.floor(Math.random()*5)
                                    });
                                }

                            },
                            error:function(jqXHR, textStatus, errorThrown){
                                    clearInterval(window.timer0);
                                    defaultStyleOne();
                                    layer.alert('网络繁忙，请重新抽取!')
                                }
                        },'json');
                        return false;
                    });
                    break;
                case 3:
                    DrawRight.show(200);
                    DrawThree.show(200);
                    DrawOne.hide(200);
                    DrawFive.hide(200);
                    layer.msg('选取中奖人数为三人');
                    defaultStyleThree();
                    $(".startBtn").attr("id","btnThree");
                    $(".stopBtn").attr("id","StopThree");
                    $(".startBtn").unbind('click');

                function fna(){
                    $(".startBtn").hide();
                    $(".stopBtn").show();
                    $(".stopBtn").css("margin-left","110px");
                    window.timer1=setInterval(chooseThree,50);
                    selectDisabled();
                }
                function fnb(){
                    $(".stopBtn").hide();
                    $(".startBtn").show();
                    selectEnabled();
                }
                    $("#btnThree").click(function(){
                        fna();
                    });
                    $(".stopBtn").unbind('click');
                    $(".stopBtn").click(function(){
                        fnb();
                        $.ajax({
                            type:'POST',
                            url:'get.php',
                            data:{
                                value:3
                            },
                            success:function(response,status,xhr){
                                if(status=='success'){
                                var info=JSON.parse(response);
                                var a=$(".DrawThree").children("div").eq(0);
                                var b=$(".DrawThree").children("div").eq(1);
                                var c=$(".DrawThree").children("div").eq(2);
                                a.find("img").attr("src",info[0][5]);
                                b.find("img").attr("src",info[1][5]);
                                c.find("img").attr("src",info[2][5]);
                                a.children("div").eq(2).text(info[0][2]);
                                b.children("div").eq(2).text(info[1][2]);
                                c.children("div").eq(2).text(info[2][2]);
                                a.children("div").eq(2).attr("openid",hex_md5(info[0][1]));
                                b.children("div").eq(2).attr("openid",hex_md5(info[1][1]));
                                c.children("div").eq(2).attr("openid",hex_md5(info[2][1]));
                                clearInterval(window.timer1);
                                layer.alert('恭喜'+info[0][2]+'、'+info[1][2]+'、'+info[2][2]+'、'+'获奖！',{
                                    skin: 'layui-layer-molv', //样式类名
                                    title:'中奖信息',
                                    anim: Math.floor(Math.random()*5)
                                });
                                }
                            },
                            error:function(jqXHR, textStatus, errorThrown){
                                clearInterval(window.timer1);
                                defaultStyleOne();
                                layer.alert('网络繁忙，请重新抽取!')
                            }
                        },'json');
                        return false;
                     });
                            break;
                            case 5:
                            DrawRight.show(200);
                            DrawFive.show(200);
                            DrawOne.hide(200);
                            DrawThree.hide(200);
                            layer.msg('选取中奖人数为五人');
                            defaultStyleFive();
                            $(".startBtn").attr("id","btnFive");
                            $(".stopBtn").attr("id","StopFive");
                            $(".startBtn").unbind('click');
                            function fnx(){
                                $(".startBtn").hide();
                                $(".stopBtn").show();
                                $(".stopBtn").css("margin-left","110px");
                                window.timer2=setInterval(chooseFive,50);
                                selectDisabled();
                            }
                            function fny(){
                                $(".stopBtn").hide();
                                $(".startBtn").show();
                                selectEnabled();
                            }
                            $("#btnFive").click(function(){
                                fnx();
                            });
                            $(".stopBtn").unbind('click');
                            $(".stopBtn").click(function(){
                                fny();
                                $.ajax({
                                    type:'POST',
                                    url:'get.php',
                                    data:{
                                        value:5
                                    },
                                    success:function(response,status,xhr){
                                        if(status=='success'){
                                        var info=JSON.parse(response);
                                        var a=$(".DrawFive").children("div").eq(0);
                                        var b=$(".DrawFive").children("div").eq(1);
                                        var c=$(".DrawFive").children("div").eq(2);
                                        var d=$(".DrawFive").children("div").eq(3);
                                        var e=$(".DrawFive").children("div").eq(4);
                                        a.find("img").attr("src", info[0][5]);
                                        b.find("img").attr("src", info[1][5]);
                                        c.find("img").attr("src", info[2][5]);
                                        d.find("img").attr("src", info[3][5]);
                                        e.find("img").attr("src", info[4][5]);
                                        a.children("div").eq(2).text(info[0][2]);
                                        b.children("div").eq(2).text(info[1][2]);
                                        c.children("div").eq(2).text(info[2][2]);
                                        d.children("div").eq(2).text(info[3][2]);
                                        e.children("div").eq(2).text(info[4][2]);
                                        a.children("div").eq(2).attr("openid",hex_md5(info[0][1]));
                                        b.children("div").eq(2).attr("openid",hex_md5(info[1][1]));
                                        c.children("div").eq(2).attr("openid",hex_md5(info[2][1]));
                                        d.children("div").eq(2).attr("openid",hex_md5(info[3][1]));
                                        e.children("div").eq(2).attr("openid",hex_md5(info[4][1]));
                                        clearInterval(window.timer2);
                                        layer.alert('恭喜'+info[0][2]+'、'+info[1][2]+'、'+info[2][2]+'、'+info[3][2]+'、'+info[4][2]+'、'+'获奖！',{
                                            skin: 'layui-layer-molv', //样式类名
                                            title:'中奖信息',
                                            anim: Math.floor(Math.random()*5)
                                        });
                                        }else {
                                            clearInterval(window.timer2);
                                            defaultStyleOne();
                                            layer.alert('网络繁忙，请重新抽取!')
                                        }
                                    },
                                    error:function(jqXHR, textStatus, errorThrown){
                                        clearInterval(window.timer2);
                                        defaultStyleOne();
                                        layer.alert('网络繁忙，请重新抽取!')
                                    }
                                },'json');
                                return false;
                            });
                            break;
                            default:
                            break;
                        }
                    });



        //一人
        $(".DrawOne .DrawName").hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });

        //三人

        var a1=$(".DrawThree").children("div").eq(0);
        var b1=$(".DrawThree").children("div").eq(1);
        var c1=$(".DrawThree").children("div").eq(2);

        a1.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });
        b1.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });
        c1.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });

        //五人
        var az=$(".DrawFive").children("div").eq(0);
        var bz=$(".DrawFive").children("div").eq(1);
        var cz=$(".DrawFive").children("div").eq(2);
        var dz=$(".DrawFive").children("div").eq(3);
        var ez=$(".DrawFive").children("div").eq(4);
        az.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });

        bz.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });

        cz.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });

        dz.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });

        ez.children("div").eq(2).hover(function(){
            layer.tips($(this).attr('openid'),this,{
                tips: [1, '#3595CC'],
                time: 4000
            });
        },function(){
            layer.closeAll('tips');
        });



            });




        //……



        //app code
    });
</script>
<script class="effects">
    new Particleground.particle('.bg');
</script>
<?php
$channel = new SaeChannel();
$comment_url = $channel->createChannel("hello", 36000);	//新建一个叫hello的Channel
?>
<script src='http://channel.sinaapp.com/api.js'></script>	<!-- 引入Channel的JS库文件 -->
<script type='text/javascript' id="chartjs">
    $(function(){
        var voteData=[
            {
                name:"第八套广播体操",
                value:0,
                color:"rgba(131,166,213,0.90)"
            },{
                name:"甄嬛后传",
                value:0,
                color:"rgba(243,125,178,0.90)"
            },{
                name:"爵士串烧",
                value:0,
                color:"rgba(237,236,238,0.90)"
            },{
                name:"恋人心",
                value:0,
                color:"rgba(143,198,64,0.90)"
            },{
                name:"赤壁",
                value:0,
                color:"rgba(100,139,191,0.90)"
            },{
                name:"青花瓷",
                value:0,
                color:"#4572a7"
            },{
                name:"咋了爸爸",
                value:0,
                color:"#2d6b80"
            },{
                name:"唐僧遇妖",
                value:0,
                color:"#4d8f42"
            },{
                name:"腊月奇迹",
                value:0,
                color:"#635116"
            },{
                name:"遥远的她",
                value:0,
                color:"#7924e0"
            },{
                name:"碰瓷",
                value:0,
                color:"#7a330a"
            },{
                name:"直到世界的尽头",
                value:0,
                color:"#4a2594"
            },{
                name:"礼轻礼重",
                value:0,
                color:"#0fc27a"
            },{
                name:"感恩的心",
                value:0,
                color:"#a12323"
            }
        ];

        var chart = iChart.create({
            render:"ichart-render",
            width:1400,
            height:700,
            background_color:"rgba(46, 59, 78,0.4)",
            gradient:false,
            color_factor:0.2,
            border:{
                color:"#404c5d",
                width:1
            },
            align:"center",
            offsetx:0,
            offsety:-20,
            sub_option:{
                border:{
                    color:"#fefefe",
                    width:1
                },
                label:{
                    fontweight:600,
                    fontsize:20,
                    color:"#f5f5f5",
                    sign:"square",
                    sign_size:12,
                    border:{
                        color:"#BCBCBC",
                        width:1
                    },
                    background_color:"#fefefe"
                }
            },
            shadow:true,
            shadow_color:"#fafafa",
            shadow_blur:10,
            showpercent:false,
            column_width:"50%",
            bar_height:"70%",
            radius:"90%",
            title:{
                text:"表演节目投票支持率，赶紧支持你喜欢的节目吧！",
                color:"#f5f5f5",
                fontsize:24,
                font:"Verdana",
                textAlign:"left",
                height:30,
                offsetx:36,
                offsety:0
            },
            subtitle:{
                text:"",
                color:"#8d9db5",
                fontsize:24,
                font:"微软雅黑",
                textAlign:"left",
                height:50,
                offsetx:36,
                offsety:6
            },
            footnote:{
                text:"微信公众号回复'投票'，即可参加投票，每人仅有一次机会",
                color:"#8d9db5",
                fontsize:14,
                font:"微软雅黑",
                textAlign:"right",
                height:30,
                offsetx:-32,
                offsety:0
            },
            legend:{
                enable:true,
                background_color:"rgba(254,254,254,0.2)",
                color:"#c1cdde",
                fontsize:13,
                border:{
                    color:"#85898f",
                    width:0
                },
                column:5,
                align:"right",
                valign:"top",
                offsetx:-32,
                offsety:-40
            },
            coordinate:{
                width:"92%",
                height:"80%",
                background_color:"rgba(246,246,246,0.05)",
                axis:{
                    color:"#bfbfc3",
                    width:["","",6,""]
                },
                grid_color:"#c0c0c0",
                label:{
                    fontweight:500,
                    color:"#f5f5f5",
                    fontsize:0
                }
            },
            label:{
                fontweight:600,
                color:"#f5f5f5",
                fontsize:10
            },
            type:"column2d",
            data:voteData
        });
        //生成图表
        chart.draw();

        var $channel_url = '<?=$comment_url?>';
        $channel = sae.Channel($channel_url);		//打开Channel
        $channel.onmessage = function (message) {
            var mesData=JSON.parse(message.data);
            // alert();	//将收到的message弹出来
            for(var i=0;i<mesData.length;i++){
                voteData[i]['value']=mesData[i]['ballot'];
            }
            chart.load(voteData);

        };
    });
</script>
</body>
</html>

