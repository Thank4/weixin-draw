<!DOCTYPE html>
<html lang="zh" xmlns="http://www.w3.org/1999/html">
<head>
	<title>2016太湖国际年会</title>

	<style>
		body {background: #363f48;color: white;font: normal 12px 'Open Sans', sans-serif;margin-top: 20px;}
		ul.countdown {list-style: none;margin: 75px 0;padding: 0;display: block;text-align: center;}
		ul.countdown li {display: inline-block;}
		ul.countdown li span {font-size: 80px;font-weight: 300;line-height: 80px;}
		ul.countdown li.seperator {font-size: 80px;line-height: 70px;vertical-align: top;}
		ul.countdown li p {color: #a7abb1;font-size: 14px;}
		ul.countdown a {color: #76949F;text-decoration: none;}
		ul.countdown a:hover {text-decoration: underline;}
		ul.countdown .source {width: 405px;margin: 0 auto;background: #4f5861;color: #a7abb1;font-weight: bold;display: block;white-space: pre;border-radius: 3px;}
		ul.countdown .btn {background: #f56c4c;margin: 40px auto;padding: 12px;display: block;width: 100px;color: white;text-align: center;text-transform: uppercase;font-weight: bold;text-decoration: none;border-radius: 2px;}
		ul.countdown .btn:hover {text-decoration: none;opacity: .7;}
		.clickBtn{border: 1px solid #ffffff;padding: 10px 50px;margin: 0 auto;display: block;width: 100px;color: #ffffff;font-size: 16px;text-align: center;background: #363f48;transition: all .5s; -webkit-transition: all .5s;}
		.clickBtn:hover{color: #363f48;border: 1px solid #363f48;background: #ffffff;border-radius: 4px}

	</style>
	<link rel="stylesheet" href="layui/css/layui.css">
	<link rel="shortcut icon" href="/favicon.ico" />
	<script src="//cdn.bootcss.com/jquery/1.3.0/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/jquery.downCount/1.0.0/jquery.downCount.js"></script>
</head>
<body>
<h1 align="center" style="margin-top:150px;font-size: 60px; word-spacing:8px;letter-spacing: 20px">2016年太湖国际年会倒计时</h1>
<ul class="countdown">
	<li> <span class="days">00</span>
		<p class="days_ref">days</p>
	</li>
	<li class="seperator">.</li>
	<li> <span class="hours">00</span>
		<p class="hours_ref">hours</p>
	</li>
	<li class="seperator">:</li>
	<li> <span class="minutes">00</span>
		<p class="minutes_ref">minutes</p>
	</li>
	<li class="seperator">:</li>
	<li> <span class="seconds">00</span>
		<p class="seconds_ref">seconds</p>
	</li>
</ul>
<div>
	<a href="javascript:void(0)" class="clickBtn">点击进入</a>
</div>
</body>
<script>
	$('.countdown').downCount({
		date: '12/31/2016 14:00:00',
		offset:8
	}, function () {
		//
		location.href="/wall?code=af57f435ccdbebb931a1b954d5d5bef7"

	});
</script>
<script src="layui/layui.js"></script>
<script>
	//外层组件先加载
	layui.use(['layer', 'form', 'element','jquery'], function(){
		var layer = layui.layer
			,form = layui.form()
			,element = layui.element();

		var $ = layui.jquery //重点处
			,layer = layui.layer;
		//jquery代码

		var hexcase=0;function hex_md5(a){ if(a=="") return a; return rstr2hex(rstr_md5(str2rstr_utf8(a)))}function hex_hmac_md5(a,b){return rstr2hex(rstr_hmac_md5(str2rstr_utf8(a),str2rstr_utf8(b)))}function md5_vm_test(){return hex_md5("abc").toLowerCase()=="900150983cd24fb0d6963f7d28e17f72"}function rstr_md5(a){return binl2rstr(binl_md5(rstr2binl(a),a.length*8))}function rstr_hmac_md5(c,f){var e=rstr2binl(c);if(e.length>16){e=binl_md5(e,c.length*8)}var a=Array(16),d=Array(16);for(var b=0;b<16;b++){a[b]=e[b]^909522486;d[b]=e[b]^1549556828}var g=binl_md5(a.concat(rstr2binl(f)),512+f.length*8);return binl2rstr(binl_md5(d.concat(g),512+128))}function rstr2hex(c){try{hexcase}catch(g){hexcase=0}var f=hexcase?"0123456789ABCDEF":"0123456789abcdef";var b="";var a;for(var d=0;d<c.length;d++){a=c.charCodeAt(d);b+=f.charAt((a>>>4)&15)+f.charAt(a&15)}return b}function str2rstr_utf8(c){var b="";var d=-1;var a,e;while(++d<c.length){a=c.charCodeAt(d);e=d+1<c.length?c.charCodeAt(d+1):0;if(55296<=a&&a<=56319&&56320<=e&&e<=57343){a=65536+((a&1023)<<10)+(e&1023);d++}if(a<=127){b+=String.fromCharCode(a)}else{if(a<=2047){b+=String.fromCharCode(192|((a>>>6)&31),128|(a&63))}else{if(a<=65535){b+=String.fromCharCode(224|((a>>>12)&15),128|((a>>>6)&63),128|(a&63))}else{if(a<=2097151){b+=String.fromCharCode(240|((a>>>18)&7),128|((a>>>12)&63),128|((a>>>6)&63),128|(a&63))}}}}}return b}function rstr2binl(b){var a=Array(b.length>>2);for(var c=0;c<a.length;c++){a[c]=0}for(var c=0;c<b.length*8;c+=8){a[c>>5]|=(b.charCodeAt(c/8)&255)<<(c%32)}return a}function binl2rstr(b){var a="";for(var c=0;c<b.length*32;c+=8){a+=String.fromCharCode((b[c>>5]>>>(c%32))&255)}return a}function binl_md5(p,k){p[k>>5]|=128<<((k)%32);p[(((k+64)>>>9)<<4)+14]=k;var o=1732584193;var n=-271733879;var m=-1732584194;var l=271733878;for(var g=0;g<p.length;g+=16){var j=o;var h=n;var f=m;var e=l;o=md5_ff(o,n,m,l,p[g+0],7,-680876936);l=md5_ff(l,o,n,m,p[g+1],12,-389564586);m=md5_ff(m,l,o,n,p[g+2],17,606105819);n=md5_ff(n,m,l,o,p[g+3],22,-1044525330);o=md5_ff(o,n,m,l,p[g+4],7,-176418897);l=md5_ff(l,o,n,m,p[g+5],12,1200080426);m=md5_ff(m,l,o,n,p[g+6],17,-1473231341);n=md5_ff(n,m,l,o,p[g+7],22,-45705983);o=md5_ff(o,n,m,l,p[g+8],7,1770035416);l=md5_ff(l,o,n,m,p[g+9],12,-1958414417);m=md5_ff(m,l,o,n,p[g+10],17,-42063);n=md5_ff(n,m,l,o,p[g+11],22,-1990404162);o=md5_ff(o,n,m,l,p[g+12],7,1804603682);l=md5_ff(l,o,n,m,p[g+13],12,-40341101);m=md5_ff(m,l,o,n,p[g+14],17,-1502002290);n=md5_ff(n,m,l,o,p[g+15],22,1236535329);o=md5_gg(o,n,m,l,p[g+1],5,-165796510);l=md5_gg(l,o,n,m,p[g+6],9,-1069501632);m=md5_gg(m,l,o,n,p[g+11],14,643717713);n=md5_gg(n,m,l,o,p[g+0],20,-373897302);o=md5_gg(o,n,m,l,p[g+5],5,-701558691);l=md5_gg(l,o,n,m,p[g+10],9,38016083);m=md5_gg(m,l,o,n,p[g+15],14,-660478335);n=md5_gg(n,m,l,o,p[g+4],20,-405537848);o=md5_gg(o,n,m,l,p[g+9],5,568446438);l=md5_gg(l,o,n,m,p[g+14],9,-1019803690);m=md5_gg(m,l,o,n,p[g+3],14,-187363961);n=md5_gg(n,m,l,o,p[g+8],20,1163531501);o=md5_gg(o,n,m,l,p[g+13],5,-1444681467);l=md5_gg(l,o,n,m,p[g+2],9,-51403784);m=md5_gg(m,l,o,n,p[g+7],14,1735328473);n=md5_gg(n,m,l,o,p[g+12],20,-1926607734);o=md5_hh(o,n,m,l,p[g+5],4,-378558);l=md5_hh(l,o,n,m,p[g+8],11,-2022574463);m=md5_hh(m,l,o,n,p[g+11],16,1839030562);n=md5_hh(n,m,l,o,p[g+14],23,-35309556);o=md5_hh(o,n,m,l,p[g+1],4,-1530992060);l=md5_hh(l,o,n,m,p[g+4],11,1272893353);m=md5_hh(m,l,o,n,p[g+7],16,-155497632);n=md5_hh(n,m,l,o,p[g+10],23,-1094730640);o=md5_hh(o,n,m,l,p[g+13],4,681279174);l=md5_hh(l,o,n,m,p[g+0],11,-358537222);m=md5_hh(m,l,o,n,p[g+3],16,-722521979);n=md5_hh(n,m,l,o,p[g+6],23,76029189);o=md5_hh(o,n,m,l,p[g+9],4,-640364487);l=md5_hh(l,o,n,m,p[g+12],11,-421815835);m=md5_hh(m,l,o,n,p[g+15],16,530742520);n=md5_hh(n,m,l,o,p[g+2],23,-995338651);o=md5_ii(o,n,m,l,p[g+0],6,-198630844);l=md5_ii(l,o,n,m,p[g+7],10,1126891415);m=md5_ii(m,l,o,n,p[g+14],15,-1416354905);n=md5_ii(n,m,l,o,p[g+5],21,-57434055);o=md5_ii(o,n,m,l,p[g+12],6,1700485571);l=md5_ii(l,o,n,m,p[g+3],10,-1894986606);m=md5_ii(m,l,o,n,p[g+10],15,-1051523);n=md5_ii(n,m,l,o,p[g+1],21,-2054922799);o=md5_ii(o,n,m,l,p[g+8],6,1873313359);l=md5_ii(l,o,n,m,p[g+15],10,-30611744);m=md5_ii(m,l,o,n,p[g+6],15,-1560198380);n=md5_ii(n,m,l,o,p[g+13],21,1309151649);o=md5_ii(o,n,m,l,p[g+4],6,-145523070);l=md5_ii(l,o,n,m,p[g+11],10,-1120210379);m=md5_ii(m,l,o,n,p[g+2],15,718787259);n=md5_ii(n,m,l,o,p[g+9],21,-343485551);o=safe_add(o,j);n=safe_add(n,h);m=safe_add(m,f);l=safe_add(l,e)}return Array(o,n,m,l)}function md5_cmn(h,e,d,c,g,f){return safe_add(bit_rol(safe_add(safe_add(e,h),safe_add(c,f)),g),d)}function md5_ff(g,f,k,j,e,i,h){return md5_cmn((f&k)|((~f)&j),g,f,e,i,h)}function md5_gg(g,f,k,j,e,i,h){return md5_cmn((f&j)|(k&(~j)),g,f,e,i,h)}function md5_hh(g,f,k,j,e,i,h){return md5_cmn(f^k^j,g,f,e,i,h)}function md5_ii(g,f,k,j,e,i,h){return md5_cmn(k^(f|(~j)),g,f,e,i,h)}function safe_add(a,d){var c=(a&65535)+(d&65535);var b=(a>>16)+(d>>16)+(c>>16);return(b<<16)|(c&65535)}function bit_rol(a,b){return(a<<b)|(a>>>(32-b))};

		//……
		//app code
		//
		$(".clickBtn").click(function(){
			layer.prompt({title:'输入开场密码或等待倒计时结束',formType:1},function(pass,index){
				layer.close(index);
				$.ajax({
					type:'GET',
					url:'wall/index.php',
					cache:false,
					data:{
						code:hex_md5(pass)
					},
					success:function(response,status,xhr){
						if(response=='ERROR:非法访问'){
							layer.msg('ERROR:密码错误或非法访问');
						}else {
							layer.msg('密码正确');
							location.href="/wall?code=af57f435ccdbebb931a1b954d5d5bef7"
						}
					}

				})
			})
		});

		//tips

	});
</script>
</html>