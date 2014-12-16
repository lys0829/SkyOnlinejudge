<?php
if(!defined('IN_TEMPLATE'))
{
  exit('Access denied');
}
?>
<div class = "container" >

    <div class="row">
        <h1>更新日誌</h1>
        
        <div>
            <time>2014-12-16</time>更新
            <ol>
                <li>CBBOARD 可以透過 <code>challink(uid,pid)</code> 取得解題改況連結，點擊圓點即可使用</li>
                <li>修復 cbfetch 一個錯誤建構空白頁面的方法</li>
                <li>模板文件<code>$_E['template']</code> 可以用<code>$tmpl</code>取代</li>
                <li>更好看的登入介面，圖片版權：創用CC <a href='http://commons.wikimedia.org/wiki/File:Sunset_(2).jpg' target="_blank">Sunset(公眾領域使用)</a>,
                <a href="http://www.public-domain-image.com/nature-landscape/hill/slides/strandhill-ireland-ocean-beaches-couds-sky.html" target="_blank">Strandhill ireland ocean beaches couds sky(公眾領域使用)</a>。</li>
            </ol>
        </div>
        
        <div>
            <time>2014-12-12</time>更新
            <ol>
                <li>TOJ驗證功能Open!</li>
            </ol>
        </div>
        
        <div>
            <time>2014-12-10</time>更新
            <ol>
                <li>可以修改密碼</li>
            </ol>
        </div>
        
        <div>
            <time>2014-12-9</time>更新
            <ol>
                <li>修復ZJ需要token的問題</li>
                <li>修復UVA一個愚蠢的變數名稱錯誤</li>
            </ol>
        </div>
        
        <div>
            <time>2014-12-4</time>更新
            <ol>
                <li>更新過時的MYSQL函數</li>
            </ol>
        </div>
        
        <div>
            <time>2014-12-3</time>更新
            <ol>
                <li>改善手機瀏覽介面</li>
                <li>更新UVA插件</li>
                <li>獨立設定檔，此版本後須自行建立 <code> LocalSetting.php </code> 以個性化網站</li>
            </ol>
        </div>
        <br>
        <!--Math Test<br>
        $a,\ b(a,\ b\ <\ 2^{63})$
        <br>-->
    </div>
    <div class="row">
        <h1>展望</h1>
        <dl class="dl-horizontal">
          <dt>廣用型記分板</dt>
          <dd>
                <ul>
                    <li><p>加入方法</p>
                    <ol>
                        <li>自由加入退出</li>
                        <li>申請制</li>
                        <li>僅管理員可修改</li>
                    </ol></li>
                    <li><p>及格分隔線</p></li>
                    <li><p>排名，可自訂計分方法</p></li>
                </ul>
          </dd>
        </dl>
    </div>
    <div class="row">
        <h1>MUSIC LOGIN ONLY~</h1>
        <?php if($_G['uid']): ?>
        <div class="col-md-5">
            <audio controls>
                <source src="http://pc2.tfcis.org/lfs/20140830/egg.mp3">
                <source src="http://pc2.tfcis.org/lfs/20140830/egg.ogg">
                HTML5 ONLY! 請升級您的瀏覽器
            </audio>
            <br>
            <div class="embed-responsive embed-responsive-4by3">
                <iframe class="embed-responsive-item" src="//www.youtube.com/embed/videoseries?list=PLvLX2y1VZ-tEmqtENBW39gdozqFCN_WZc" allowfullscreen></iframe>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="row">
        <h2><a href="http://www.tfcis.org/~forummaker/sojwiki/">SOJWiki</a></h2>
    </div>
</div>