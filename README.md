Tyozo-Modoki [![Build Status](https://travis-ci.org/k725/Tyozo-Modoki.svg?branch=master)](https://travis-ci.org/k725/Tyozo-Modoki)
============


----------

とりあえず
--

Q. なにこれ  

> [Tyozo][1]のアイデアをアレしました。ソースコードは流用してないです。
> オレオレGyazoのファイル管理を行うものです。  
> 簡単に削除、閲覧することを目的としているのでそれ以外の方は[AjaXplorer][2]をオススメします


----------

特徴
--

 - ナウい感じでファイルを消せます。
 - アップロードサーバも兼ねてます。 

[Gyazo+][3]での設定例

    [Gyazo+]
    upload_server=example.com
    upload_path=/cp.php?upload

----------

必要なもの
-----

 - Apache
 - mod_rewrite
 - php5
 - php5-gd


----------

注意
--

**.htaccessに目を通してから使用してください。**  
必要なものに書いてあるものだけで動きますが、**絶対にドメイン直下で運用してください。**  
認証周りは面倒なのでBASIC認証等でカバーしてます…

なお、デフォルトの.htpasswdのユーザ名/パスワードはuser: admin/password: test です。  
設定ファイルは tyozo-modoki/server/settings.php です。


----------

LICENSE
-------

This software licensed under MIT/X11 License.
Please see LICENSE file.


  [1]: https://github.com/tyoro/tyozo
  [2]: http://pyd.io/
  [3]: https://github.com/k725/GyazoPlus