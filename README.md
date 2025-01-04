<h1>お問い合わせフォーム</h1>
<h2>環境構築</h2>
<h3>Dockerビルド</h3>
<ol>
  <li>git clone リンク</li>
  <li>docker-compose up -d --build</li>
</ol>

<h3>Laravel環境構築</h3>
<ol>
  <li>docker-compose exec php bash</li>
  <li>composer install</li>
  <li>.env.exampleファイルから.envを作成し、環境変数を変更</li>
  <li>php artisan key:genarate</li>
  <li>php artisan migrate</li>
  <li>php artisan db:seed</li>
</ol>

<h3>使用技術</h3>
<ul>
  <li>Laravel Framework 8.83.8</li>
  <li>MySQL 8.0.26</li>
</ul>

<h3>ER図</h3>

<h3>URL</h3>
<ul>
  <li>開発環境：http://localhost/</li>
  <li>phpMyAdmin：http://localhost:8080/</li>
</ul>

<h3>備考</h3>
<ul>
  <li>http://localhost/admin の機能がほぼできていません</li>
  <li>ER図も作成できていません</li>
</ul>
