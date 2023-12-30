=== Simplistic page navi ===
Contributors: strix-bubol5
Donate link: 
Tags: navigation, pagination, paging, pages, pager
Requires at least: 4.5
Tested up to: 6.1
Stable tag: 5.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

シンプルですがいくつかの機能を持ったページ番号によるリンクリストを表示します。

== Description ==
ページ番号を入力しエンターキーで目的のページへ遷移させるインプットボックスを備えています。

リストを逆順に表示させることができます。

デフォルトで何種類かのサンプルスタイルシートを備えています。

それぞれのページにおいていくつかのオプションを配列により引数として関数に渡すことで、同じページ内においても複数のページリストでスタイル以外の表示を変えることができます。

ページの上部と下部に2つのページリンクリストを表示させることはよくあることだと思います。その場合、二度目に関数が呼び出されたときは、二度同じ処理をさせないために、一度目で作成したリストをメモリーしたものを再利用します。

Gutenberg Block Editor 用の block を備えています。

仮に、html やら php を全く触れないという場合でも、表示させたい場所の html の要素の ID を指定さえすれば、プラグインは Javascript を使ってその要素の先頭と末尾にページリストを挿入します。
さらに、html の要素の ID などなんのことかさっぱり、という場合、プラグインのオプション設定ページに入り、"Page-lists outputted by javascript" の欄に試しに "search" と入力してみて下さい。プラグインが本文のコンテンツを探し、運良く見つけられたら、Javascript を使って、その HTML要素の先頭と末尾に page-list を挿入します。もしかするとうまくいくかもしれません。

== Installation ==

1.ダウンロードし解凍してできた`simplistic_pagenavi.php`が入っている`simplistic_pagenavi`フォルダごとプラグインディレクトリ`/wp-content/plugins/`にアップロードします。
2.WordPressのプラグインメニューにおいてプラグインを有効化します。
3.管理画面の設定メニューに入り、各設定をします。
4.このプラグインを起動させるテンプレートタグ"splcpn_echopager"を以下のようにして、表示させたいテーマの箇所に記入します。
`
<?php
	if ( function_exists( 'splcpn_echopager' ) ) {
		splcpn_echopager( 1 );
	}
?>
`
この時、パラメータを一つ、値を1でセットすると生成されるHTMLの最外のタグのidが以下のようになります。
`<nav id="toppagelink"><div class="pagenavilist">....`

このパラメータを0または省略する（デフォルトが0なので省略可）と以下のようになり、
同じページ内で二つ表示させる場合にそれぞれにおいて詳細な位置設定が出来るようになります。
`<nav id="bottompagelink"><div class="pagenavilist">....`

他のパラメータ（オプションと同じですがスタイルシートに関する物は指定しても意味がありません）においては、配列により第二引数として指定することもできます。

関数の引数にてオプションを指定すれば、同じページ内であっても異なる表示をさせることができます。（例：上がフルリストで下に必要最小限の構成のリストなど）

以下は指定できるもの全て表記してありますが、実際には必要のある項目だけを配列にして指定します。

配列にて第二引数を指定する場合は、上記の第一引数がたとえデフォルトの0であっても必ず指定する必要があります（無いとエラーになります）。

パラメータの最後の'max_page_num'はオプション値ではありません。たとえば、固定ぺージにおいてWP_Queryを使って特定のカテゴリとか投稿タイプとかの一覧をとるなどした場合など、$wp_query->max_num_pagesに値が無い場合があり、その場合にページネーションが機能しなくなります。何らかの方法で全ページ数が得られるはずですから、その値をこのパラメータで指定します。
`
<?php
	if ( function_exists( 'splcpn_echopager' ) ) {
		$args = array(
			'reverse' => '0', // リストの並び方 0:通常の左から 1:逆順で右から
			'above' => '7', // この数値より全ページ数が多い時にダイレクトジャンプのインプットボックスを表示、 default:7
			'minimum_unit' => '1', // 0:必要最小限の要素のリスト 1:通常のフルリスト
			'adjacent_num'=> '3',// 現在のページに隣接する前後の番号ページの表示数、片側だけの数値を指定 1から5
			'larger_page'=> '3',// ページ数が多い時に表示する10の倍数ページの数を指定、片側だけの数値を指定 0から5
			'top_label' => 'Top',
			'last_label' => 'Last',
			'connection_str'=>'~',// 10の倍数ページを表示したときなどの離れたページの間に表示する文字、3文字.
			'div_id'=>'pagenavilist',// 親タグ<div>のID属性の文字列.
			'font_size'=>'0',//フォントサイズ指定. -10~10, 0を指定することで無効. -10 : 0.5em ~ 10 : 1.5em, 0.05em間隔.
			'top_text_align'=>'0',// Text-align of id="toppagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
			'top_margin'=>'',// Margin of id="toppagelink" of "nav" tag. 空で無効、 top:right:bottom:left のように数字を:で区切った書式で入力。cssの書式と同様で省略した書き方が可能。
			'bottom_text_align'=>'0',//  最外の親タグである<nav>のid="bottompagelin"のtext-align設定。  0 : disable, 1:left, 2: right, 3:center.
			'bottom_margin'=>'',//  最外の親タグである<nav>のid="bottompagelin"のmargin設定。"top_margin"と同様。
			'distant_num'=>'3',// 現在のページが最初か最後に寄っている時など残りの間隔が広い時に表示する100の位のページの数。
			'max_page_num'=>$wp_query->max_num_pages,// 全ページ数を指定。固定ページなどで$wp_query->max_num_pagesに値が入っていない場合、このパラメータによる全ページ数を指定することで機能します。
		);
		splcpn_echopager( 0, $args );
	}
?>
`

また、ページによって背景色を変えているなど、それに合わせてページリストの色も変えたいというような場合において、
ページによって読み込ませるスタイルシートを変更することが出来ます。

その場合は、オプションの"Load style sheet"の項目を0に設定し、テンプレートheader.phpのwp_head ()タグより前で
"direct_splcpn_style"関数を呼び出してください。

例えば、以下の例では乱数によりランダムにスタイルシートを変更しています（デフォルトのスタイルシートは1～6で指定できます）。

`
<?php
	$splcpn_num = rand( 1, 6 );
	direct_splcpn_style( $splcpn_num );
	wp_head();
?>
`

== Frequently asked questions ==

= 対応しているウェブブラウザは何ですか？ =
HTML5とCSS3に対応しているウェブブラウザに対応しています。

= 対応している言語は何ですか？ =
日本語と英語の対応ですが、英語は改善が必要だと思われます。

= プラグインを削除した後、保存されているオプションの値はどうなりますか？ =
WordPressのプラグインメニューからプラグインを削除すれば、保存されているオプション値も消去されます。

== Screenshots ==

1. page list styling samples.
2. reverse list and minimum list.
3. Option page english.

== Changelog ==
= 5.1 =
2022年11月12日
*  Bug fixed : オプションにおいて親タグに設定できる text-align 設定で center が適用されなかった件の修正。

= 5.0  =
2022年11月7日
*  page-list 生成関数を完全に新しく作り直し高速化。
*  Gutenberg Block Editor 用のカスタムブロックを apiVersion2 にアップデート。
*  php8.1 に対応。

= 4.0 =
2021年9月8日
*  Gutenberg block editor 用の block を装備。
*  テンプレートに関数名を記述することなく、Javascript から page-list の HTML 要素を追加できる機能を付加した。
*  機能していなかった option:Maximum number of hundreds place pages to display list を機能するように修正した。
*  url のパラメータに配列の値が存在する時に、関数get_url_parameterにおいて、PHPで出ていた Warning:  Array to string conversion formatting.php の件を修正しました。
*  プログラムを見直し、速度アップを図った。

= 3.0 =
2019年12月11日
*  管理画面からプラグインを削除したときに、データベースに保存してあるオプション値を消去する方法をuninstall.phpのファイルを使用する方法に変更。
*　ページリストを作成する部分の関数を無駄な処理を省くために全く新しく書き直し。速度アップも図る。

2017年8月23日
*  ナロースクリーン用のメディアクエリのmax-widthの初期値設定の変更。

= 2.1 =
2016年8月16日
*  最後に/が付かないパーマリンク設定の時に？によるパラメータがついているとリンクがおかしくなる状態を改良しました。

= 2.0 =
2016年8月12日
*  より高速化のためにナンバーリンク作成関数を大幅に改良しました。
*  必要最小限表示においてページ数が少ない時に1ページへのリンクが表示されなかったバグを修正しました。

= 1.0 =
2016年7月1日
*  「Simplistic page navi」 プラグインをリリースしました。

== Upgrade notice ==



== Arbitrary section 1 ==

