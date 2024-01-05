<?php
/**
Plugin Name: Simplistic page navi
Plugin URI: https://strix.main.jp/?diys=wp-pager-remake
Description: This plug-in displays page navigation list with number-input of direct jump and enable the list in reverse order.
Version: 5.1
Requires PHP: 7.0
Author: Hironori Masuda
Author URI: https://strix.main.jp/?page_id=16227
License: GPL v2 or later
Text Domain: splcpnl
Domain Path: /languages

Copyright 2016 Hironori Masuda (email : strix.ss@gmail.com)

Simplistic page navi is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Simplistic page navi; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//既存のオプション値を強制的にデフォルトに戻す時使用
//delete_option('splcpn_options');

// クラスが定義済みか調べる
if ( ! class_exists( 'Simplistic_Page_Navi_List' ) ) {

class Simplistic_Page_Navi_List {

	private $current;
	private $default;
	private $ret_option;
	private $option_name;
	private $stylenum;
	private $td_loaded;
	private $domain;
	private $current_url = '';
	private $url_parameter = array();
	private $page_list = array();
	private $version = '5.1';


	public function __construct() {
		$this->option_name = 'splcpn_options';
		$this->td_loaded = false;
		$this->domain = 'splcpnl';
		$this->load_option();
	}

	private function load_option() {

		// options default value オプションのデフォルト値設定
		$this->default = array(
			'style'=>'3', // style : 0:don't load style sheet file, 1:standard design, 2:circle design, 3:circle white back, 4:circle orange back, 5:simple square, 6:white gradation
			'reverse'=>'0', // reverse list : 0:standard left start、1:reverse
			'above'=>'7', // direct jump box showed above page count
			'nr_style'=>'770',// This number is pixel value of madia query\'s max-width. The style of narrow screen will be showed if this number isn't 0. Default is 770
			'minimum_unit'=>'1',// list of minimum unit, 0: minimum, 1: standard
			'adjacent_num'=>'3',// Number of pages that adjacent to current page to display list
			'larger_page'=>'3',// Maximum number of larger page to display list
			'top_label'=>'Top',// Label of 'to top page'
			'last_label'=>'Last',// Label of 'to last page'
			'connection_str'=>'~',// Connection string, empty is disable.
			'div_id'=>'pagenavilist',// Id strings of parent div tag.
			'font_size'=>'0',// specify font size.
			'top_text_align'=>'0',// Text-align of  id selector "toppagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
			'top_margin'=>'',// Margin of  id selector "toppagelink" of "nav" tag. Empty is disable, top:right:bottom:left. This value can have from one to four values same as the format of css.
			'bottom_text_align'=>'0',// Text-align of  id selector "bottompagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
			'bottom_margin'=>'',// Margin of  id selector "bottompagelink" of "nav" tag. Same as "top_margin". 
			'distant_num'=>'3',// Number of pages to display list when the wide distance from the edge label.
			'hidden_wplinkpages'=>'0',// erase wp_link_pages output. 0:show, 1:erase
			'js_output'=>'',// page list output by javascript. disable->'', enabel->target element id^topstyle(option)^bottomstyle(option)
			'en_gutenblock' => '0',// gutenberg block editor での custom widget block の登録、1:enable、0:disable
		);
		$this->current = get_option( $this->option_name );

		// 初使用の時などオプションが設定されていない時
		if ( false === $this->current ) {

			// デフォルトでオプション設定
			update_option( $this->option_name, $this->default );
			$this->ret_option = $this->default;

		} else {

			$deff = array_intersect_key( $this->default, $this->current );
			$countary = array( count ( $this->default ) , count ( $this->current ) , count ( $deff ) );

			if ( 1 !== count ( array_unique( $countary ) ) ) {
				foreach ( $this->current as $key => $val ) {
					if ( isset ( $this->default[ $key ] ) ) {//　デフォルトオプションにそのキーが存在する要素だけ保存されている値で上書き。
						$this->default[ $key ] = $val;
					}
				}
				update_option( $this->option_name, $this->default );
				$this->ret_option = $this->default;

			} else {
				$this->ret_option = $this->current;
			}
		}

		$rstyle = 0;
		$rstyle = ( int )$this->ret_option['style'];
		$rstyle = abs ( $rstyle )  % 7;// 0 ~ 6
		$this->stylenum = $rstyle;

		// スタイルシートの登録
		if ( 0 !== $this->stylenum ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'splcpn_style' ) );
		}

		// ナロースクリーン用のスタイルを吐き出すための登録
		if ( ( int ) $this->ret_option['nr_style'] ) {
			add_action( 'wp_head', array( $this, 'echo_nr_style' ) );
		}

		// 既存のテーマに存在するwp_link_pagesの出力を消去する関数の登録
		// filter : paginate_links_output は /wp-includes/general-template.php -> pagenate_links() にあり
		if ( ( int ) $this->ret_option['hidden_wplinkpages'] ) {
			add_filter( 'paginate_links_output', array( $this, 'hidden_wp_link_pages' ), 10, 1 );
		}

		if ( ( int ) $this->ret_option['en_gutenblock'] ) {
			add_action( 'init', array( $this, 'gb_register_block' ) );
		}

		$this->get_url_parameter();

		// $this->ret_option['js_output'] = 'content^width:60%;margin:0 auto;font-size:0.7em;background-color:lightgreen;^font-size:1.2em;background-color:lightblue';
		if ( '' !== $this->ret_option['js_output'] ) {
			add_action( 'wp_head', array( $this, 'js_output' ) );		
		}
	}

	public function gb_register_block() {

		if ( ! function_exists( 'register_block_type' ) ) {
			// Gutenberg が有効でない場合は何もしない
			return;
		}

		wp_register_script(
			'smplstc-pn-01',
			plugins_url( 'smplstcpn_gb.js', __FILE__ ),
			array( 'wp-blocks', 'wp-block-editor', 'wp-element', 'wp-i18n', 'wp-components', 'wp-server-side-render' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'smplstcpn_gb.js' )
		);

		if ( 0 === $this->stylenum ) {
			$numstyle = mt_rand( 1, 6 );
		} else {
			$numstyle = $this->stylenum;
		}
		$stylefile = $this->splcpn_select_style( $numstyle );

		wp_register_style(
			'smplstc-pn-editor-style',
			plugins_url( $stylefile, __FILE__ ),
			array( 'wp-edit-blocks' ),
			filemtime( plugin_dir_path( __FILE__ ) . $stylefile )
		);

		// namespace /block-name , namespace: spcific unique, both only use lowercase alphanumeric characters or dashes
		register_block_type( 'smplstc-pn/pagenum-link',			
			array(
				'api_version' => 2,
				'editor_script' => 'smplstc-pn-01',
				'editor_style' => 'smplstc-pn-editor-style',
				'render_callback' => array( $this, 'smplstcpn_render_callback' ),
				'attributes' => array(
					'prtid' => array( 'type' => 'string', 'default' => '0' ),
					'miniunit' => array( 'type' => 'string', 'default'=> $this->ret_option['minimum_unit'] ),
					'pagenum' => array( 'type' => 'string', 'default' => '1' ),
					'pagecount' => array( 'type' => 'string', 'default' => '400' ),
				)
			)
		);

		// block editor 用翻訳ファイル読み込み、プラグイン用翻訳ファイル読み込み関数は別にある-> load_text_domain()
		wp_set_script_translations(
			'smplstc-pn-01',
			'smplstc-pn',
			plugin_dir_path( __FILE__ ) . 'languages'
		);
	}
	
	public function smplstcpn_render_callback( $attributes ){
		$str = '';
		/*$str = '<span>';
		foreach ( $attributes as $key => $val ) {
			$str .= $key . '=' . $val . '_';
		}
		$str .= '</span>';*/
		$prtid = ( int ) $attributes['prtid'];
		$param = array(
			'minimum_unit' => $attributes['miniunit'],
			'pagenum' => $attributes['pagenum'],
			'pagecount' => $attributes['pagecount'],
		);

		$ret_cont = $this->splcpn_echopagelist( $prtid, $param );

		return $ret_cont;
	}

	public function hidden_wp_link_pages( $r ) {
		$r = '';
		return $r;
	}

	// 現在表示されているページのurl
	private function treat_current_url() {
		$this->current_url = get_pagenum_link( 1 );
	}

	// ページナンバーによるページリンクの作成
	private function make_pagenumlink( $pagenum = 1 ) {
		global $wp_rewrite;
		$targetlink = '';
		if ( '' !== $this->current_url ) {
			$targetlink = $this->current_url;

			if ( $pagenum > 1 ) {
				if ( $wp_rewrite->using_permalinks() ) {
					if ( false === strpos( $this->current_url, '?' ) ) {
						$targetlink = trailingslashit( $this->current_url ) . user_trailingslashit( $wp_rewrite->pagination_base . '/' . $pagenum, 'paged' );
					} else {
						if ( false === strpos( $this->current_url, '/?' ) ) {
							$slash = '/';
						} else {
							$slash = '';
						}
						$targetlink = str_replace( '?', $slash . $wp_rewrite->pagination_base . '/' . $pagenum . '/?', $this->current_url );
					}
				} else {
					if ( false === strpos( $this->current_url, '?' ) ) {
						$connection = '?';
					} else {
						$connection = '&amp;';
					}
					$targetlink = $this->current_url . $connection . 'paged=' . $pagenum;
				}
			}
		}
		return $targetlink;
	}

	// スタイルシート選択関数
	private function splcpn_select_style( $rstyle ) {

		$clary = array( '', 'st', 'cl', 'cd', 'co', 'sh', 'gr' );
		$tarfile = 'style_splc_pn_' . $clary[ $rstyle ] . '.css';
		return $tarfile;
	}

	// サイト読み込み時にオプション指定のスタイルシートを登録する関数
	public function splcpn_style() {
		$stylefile = $this->splcpn_select_style( $this->stylenum );
		wp_enqueue_style( 'splc_pn_style', plugins_url( $stylefile, __FILE__ ), false, date( 'YmdHis', filemtime(plugin_dir_path( __FILE__ ).$stylefile )) );
	}

	// テンプレートから指定のスタイルシートを登録する関数
	public function template_splcpn_style( $dir = 0 ) {

		if ( $dir > 6 ) {
			$dir = 0;
			return;
		}

		if ( 0 !== $dir and 0 === $this->stylenum ) {
			$stylefile = $this->splcpn_select_style( $dir );
			wp_enqueue_style( 'splc_pn_style', plugins_url( $stylefile, __FILE__ ), false, date( 'YmdHis', filemtime(plugin_dir_path( __FILE__ ).$stylefile )) );
		}
	}

	// javascript により、指定した要素の先頭と最後にpage list を追加する
	// そのjavascript をヘッダーに書き出す
	public function js_output() {
		$target = explode ( '^', $this->ret_option['js_output'] );
		$inope = array( false, false );
		$topstyle = '';
		$bottomstyle = '';
		if ( ! isset( $target[1] ) and ! isset( $target[2] ) ) {
			$inope = array( true, true );
		} else {
			if ( isset ( $target[1] ) and $target[1] ) {
				$topstyle = $target[1];
				$inope[0] = true;
			}
			if ( isset ( $target[2] ) and $target[2] ) {
				$bottomstyle = $target[2];
				$inope[1] = true;
			}
		}

		include_once 'js_output.php';
	}

	// ↓ここから管理画面のメニューにオプション設定ページを登録する処理
	public function splcpn_add_menu() {
		$this->load_text_domain();
		add_options_page( 'Simplistic Page-navi Option', 'Simplistic Page-navi Option', 'administrator', 'splcpn_plugin_options', array( $this, 'splcpn_page_output' ) );
		add_action( 'admin_init', array( $this, 'register_splcpn_settings' ) );
	}
	 
	public function register_splcpn_settings() {
		register_setting( 'splcpn-settings-group', $this->option_name );
	}
	
	public function splcpn_page_output() {
?>
		<div class="wrap" style="font-size:1.2em;">
			<h2>Simplistic Page-navi v<?php echo $this->version; ?> option </h2>
			<form method="post" action="options.php">
<?php
			settings_fields( 'splcpn-settings-group' );
			do_settings_sections( 'splcpn-settings-group' );

			include_once 'explain.php';

	}
	//↑ここまで

	// direct jump用のinputを表示するための処理
	// パーマリンク設定が基本のときのためにurlパラメータを取得
	private function get_url_parameter() {
		$params = $_GET;
		if ( $params ) {
			foreach ( $params as $key => $val ) {
				if ( ! is_array( $val ) ) {
					if ( 'paged' !== $key ) {
						$tmpkey = esc_attr( $key );
						$tmpval = esc_attr( $val );
						$this->url_parameter[ $tmpkey ] = $tmpval;
					}
				}
			}
		}
	}

	// ページナンバーリストを作成する関数
	private function make_page_num_list ( $current, $allpagecount, $setting = array( 3, 3, 3 ) ) {

		if ( $current > $allpagecount ) {
			return array();
		}
	
		if ( 3 !== count ( $setting ) ) {
			$setting = array( 3, 3, 3 );// 0->1の位、1->10の位、2->100の位 表示するページの個数の各設定
		}
	
		$pglist = array(
			'triplef' => array(),
			'doublef' => array(),
			'onef' => array(),
			'current' => array( $current ),
			'oneb' => array(),
			'doubleb' => array(),
			'tripleb' => array(),
		);
		$basenum = array( 'f' => $current, 'b' => $current );
	
		// 全てのページ番号による配列を生成
		$allpages = range( 1, $allpagecount );
		// 1ページから現在のページまで含む分の配列を抜き出す
		$front = array_slice( $allpages, 0, $current );
		// 現在のページより後ろの分の配列を抜き出す。（現在のページは含まない）
		$back = array_slice( $allpages, $current );
	
		// 現在のページの前後、隣接したページ番号の生成
		// 前部分の配列の後ろから現在のページを除いて、指定された個数だけ配列を取り出す
		$pglist['onef'] = array_slice( $front, ( $setting[0] + 1 ) * -1, -1 );
		if ( $pglist['onef'] ) {
			$basenum['f'] = $pglist['onef'][0];
		}
		// 後部分の配列の先頭から指定された個数だけ配列を取り出す。
		$pglist['oneb'] = array_slice( $back, 0, $setting[0] );
		if ( $pglist['oneb'] ) {
			$basenum['b'] = end( $pglist['oneb'] );
		}
	
		// 隣接した番号に続く、10の倍数のページの生成
		// 総ページ数が10ページより多い時だけ
		if ( $allpagecount > 10 ) {
			// 0から総ページ数以内で、10の倍数の配列を生成、eq. 0,10,20,30,・・・
			$doublenum = range( 0, $allpagecount, 10 );
	
			// if ( ( $allpagecount - $current ) > 10 ) {
				$dblover = floor ( ( $basenum['b'] + 2 ) / 10 ) + 1;
				$tmpdbb = array_slice( $doublenum, $dblover );
				$pglist['doubleb'] = array_slice( $tmpdbb, 0, $setting[1] );
				if ( $pglist['doubleb'] ) {
					$basenum['b'] = end( $pglist['doubleb'] );
				}
			// }
	
			if ( $basenum['f'] > 12 ) {
				if ( $setting[1] > 0 ) {
					$dblunder = floor( ( $basenum['f'] - 2 ) / 10 );
					$tmpdbf = array_slice ( $doublenum, 1, $dblunder );
					// $pglist['doublef'] = array_slice( $tmpdbf, ( count ( $tmpdbf ) - $setting[1] ), $setting[1] );
					$pglist['doublef'] = array_slice( $tmpdbf, ( $setting[1] * -1 ) );
					if ( $pglist['doublef'] ) {
						$basenum['f'] = $pglist['doublef'][0];
					}
				}
			}
	
			if ( $allpagecount > 100 ) {
				$triplenum = range( 0, $allpagecount, 100 );
	
				$tplover = ceil ( $basenum['b'] / 100 );
				$tmptpb = array_slice( $triplenum, $tplover );
				$pglist['tripleb'] = array_slice( $tmptpb, 0, $setting[2] );
	
				if ( $basenum['f'] > 100 and $setting[2] > 0 ) {
					$tplunder = floor( ( $basenum['f'] - 1 ) / 100 );
					$tmptpf = array_slice ( $triplenum, 1, $tplunder );
					$pglist['triplef'] = array_slice( $tmptpf, ( $setting[2] * -1 ) );
					/*$from = count ( $tmptpf ) - $setting[2];
					if ( $from < 0 ) {
						$from = 0;
					}
					$pglist['triplef'] = array_slice( $tmptpf, $from, $setting[2] );*/
				}
			}
		}
	
		return $pglist;
	}
	
	// 以降、ページナビを表示する関数
	// 引数の$dirはサイトの上部と下部に表示する場合にidを別にするためのもの
	// その他の引数はオプション値と同じで配列により渡す
	public function splcpn_echopagelist( $dir = 0 ) {
		global $wp_query;
		$admin_page = false;

		$dir = $dir & 1;

			// ページ番号と合計ページ数を取得
		if ( get_query_var('paged') ) {
			$page_no = ( int ) get_query_var('paged');
		} else {
			$page_no = 1;
		}
		// $page_counts = ( int ) $wp_query->max_num_pages;

		// 配列による引数があればオプション値を上書き
		// 規定の引数$dirがあるためfunc_num_args()>1であり$args[1]が配列により渡された引数となる
		if ( func_num_args() > 1 ) {
			$args = func_get_args();
			$current_option = array_merge( $this->ret_option, $args[1] );
		} else {
			$current_option = $this->ret_option;
		}

		// 管理画面の時は規定の数値で page-list を組み立てる
		// 管理画面において server side render における処理では is_admin は決まって false を返す
		if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			$page_no = ( int )$current_option['pagenum'];
			$page_counts = ( int ) $current_option['pagecount'];
			$admin_page = true;
		} else {
			$page_counts = ( int ) $wp_query->max_num_pages;
		};

		if ( '' === $this->current_url ) {
			$this->treat_current_url();
		}

		if ( isset( $current_option['max_page_num'] ) ) {
			$page_counts = ( int ) $current_option['max_page_num'];
		}

		// Direct Jump box を表示するページ数の設定
		$splcpn_above = ( int ) $current_option['above'];

		// 最外の<nav>タグのid属性の設定
		$topnav = 'bottom';
		if ( 1 === $dir ) {
			$topnav = 'top';
		}

		// 逆順表示のための設定
		$rev = ( int ) $current_option['reverse'];
		// label の文字列
		$totop = esc_html( $current_option['top_label'] );
		$tolast = esc_html( $current_option['last_label'] );

		if ( 0 === $rev ) {
			$totop = '&laquo;' . $totop;
			$tolast .= '&raquo;';
			$pr = '&lt;';
			$nt = '&gt;';
		} else {
			$totop .= '&raquo;';
			$tolast = '&laquo;' . $tolast;
			$pr = '&gt;';
			$nt = '&lt;';
		}

		// 現在のページに隣接するページ番号をいくつ表示するかの設定
		$adjacent = ( int ) $current_option['adjacent_num'];
		$adjacent = abs( $adjacent )  % 6;
	
		// 10の倍数のページ番号をいくつ表示するかの設定
		// $largerp = 0;
		$largerpnum = ( int ) $current_option['larger_page'];
		$largerpnum = abs( $largerpnum ) % 6;
		// $largerp = $largerpnum * 10 + 10;

		// 間隔が100より多い時に、100の位のページを表示する。
		$distant = ( int ) $current_option['distant_num'];
		$distant = abs( $distant ) % 15;

		// ページ番号の間隔をつなく文字列の設定
		$connectstr = '';
		if ( $current_option['connection_str'] ) {// 0, '0', '', null, array()は全てfalse
			$connectstr = esc_html( substr( $current_option['connection_str'], 0, 3 ) );
			$connectstr = '<span class="extend nrnodisp">' . $connectstr . '</span>';
		}

		$idstr = '';
		$idstr = $current_option['div_id'];
		if ( 'pagenavilist' !== $idstr ) {
			if ( ! $idstr ) {
				$idstr = 'pagenavilist';
			} else {
				$idstr = htmlspecialchars( $idstr, ENT_QUOTES, 'UTF-8' );
			}
		}

		$titles = array( '', '', '', '' );
		//$showtitleに1を指定した場合、両端のリンクタイトルが表示
		$showtitle = 0;
		if ( 1 === $showtitle ) {
			$titles[0] = ' title="Jump! newest posts page"';
			$titles[1] = ' title="Next newer posts page!"';
			$titles[2] = ' title="Previous older posts page!"';
			$titles[3] = ' title="Jump! oldest posts page"';
		}

		$fontsize = ( int ) $current_option['font_size'];

		$alin_mgn = array(
			array( $current_option['bottom_text_align'], $current_option['bottom_margin'] ),
			array( $current_option['top_text_align'], $current_option['top_margin'] ),
		);

		$textalign = ( int ) $alin_mgn[ $dir ][0];
		$margin = ( string ) $alin_mgn[ $dir ][1];// null は文字列にキャストすると '' 空文字となるから下で strlen は0になる

		$navstyle = '';

		// if ( '' !== $margin  and ! is_null( $margin ) ) {// 0または’0’は有効な数字
		if ( strlen( $margin ) ) {
			$tmpmargin = explode( ':', htmlspecialchars( $margin, ENT_QUOTES, 'UTF-8' ) );
			$margins = '';
			foreach ( $tmpmargin as $val ) {
				if ( $val ) {
					if ( is_numeric( $val ) ) {
						$unit = 'px';
					} else {
						$unit = '';
					}
					$margins .= $val . $unit . ' ';
				}
			}
			$navstyle =  'margin:' . trim( $margins ) . ';';
		}

		if ( 0 !== $fontsize ) {
			$emsize = 1 + 0.05 * $fontsize;
			$navstyle .= 'font-size:' . ( string ) $emsize . 'em;';
		}

		$textalign = abs ( $textalign )  % 4;
		$align_vals = array( '', 'text-align:left;', 'text-align:right;', 'text-align:center;' );
		$navstyle .= $align_vals[ $textalign ];

		if ( $navstyle ) {
			$navstyle = ' style="' . $navstyle . '"';
		}

		//  ここから実際のリスト表示
		// ページリストを格納する二次元配列
		$liststr = array();
		$showstr = '';

		$templink = '';

		$disabled = '';// admin 画面の時にform のsubmit をdisabled に設定するときに必要

		if ( $page_counts > 1 ) {
			$showstr .= '<nav id="' . $topnav . 'pagelink"' . $navstyle .'><div class="' . $idstr . '">';
			$showstr .= '<!-- Simplistic Page-navi list ver.' . $this->version . ' -->';
			$showstr .= '<form method="get" class="jump-form" action="">';
			$showstr .= '<span class="pages">' . $page_no . '/' . $page_counts . '</span>';

			if ( $this->page_list ) {
				$showstr .= "\n<!-- re-used version Page-navi list -->\n";

				$liststr = $this->page_list;
				if ( 1 === $rev ) {
					$liststr = array_reverse( $this->page_list );
				}
				if ( '0' === $current_option['minimum_unit'] ) {
					foreach ( $liststr as $val ) {
						if ( isset ( $val[1] ) ) {
							$showstr .= $val[0];
						}
					}
				} else {
					foreach ( $liststr as $val ) {
						$showstr .= $val[0];
					}
				}

				$this->page_list = array();
			} else {

				$templink = '<a href="' . $this->make_pagenumlink() . '" class="first"' . $titles[0] . '>' . $totop . '</a>';
				if ( '0' === $current_option['minimum_unit'] ) {// enable minimum_unit
					if ( 1 !== $page_no ) {
						$liststr[] = array( $templink, 1 );
					}
				} else {
					if ( ( $page_no - $adjacent ) > 0 ) {
						$liststr[] = array( $templink ) ;
					}
				}
				if ( $page_no > 1 ) {
					$templink = '<a href="' . $this->make_pagenumlink( $page_no - 1 ) . '" class="previouspostslink" rel="next"' . $titles[1] . '>' . $pr . '</a>';
					$liststr[] = array( $templink, 1 );
				}

				$tmplist = $this->make_page_num_list ( $page_no, $page_counts, array( $adjacent, $largerpnum, $distant ) );

				$keys = array( 'current' => '', 'oneb' => '' );
				$numary = array();

				foreach ( $tmplist as $key => $value ) {
					$kara = array( $connectstr, '*' );
	
					if ( isset( $keys[ $key ] ) or ! $value ) {
						$kara = array( '', '' );
					}
					$liststr[] = array( $kara[0] );
					$numary[] = $kara[1];
	
					foreach ( $value as $val ) {
						$numary[] = $val;
	
						if ( 'current' === $key ) {
							$liststr[] = array( '<span class="current">' . ( string ) $val . '</span>', 1 );
						} else {
							$liststr[] = array( '<a href="' . $this->make_pagenumlink( $val ) . '" class="pagelarger nrnodisp">' . ( string ) $val . '</a>' );
						}
					}
				}

				$numary = array_values( array_filter( $numary ) );

				if ( '*1' === ( $numary[0] . ( string ) $numary[1] ) ) {
					$res = array_search( array( $connectstr ), $liststr );

					if ( false !== $res ) {
						unset ( $liststr[ $res ] );
					}
				}
				if ( ( int ) $page_counts !== ( int ) end( $numary ) ) {
					$liststr[] = array( $connectstr );
				}

				if ( $page_no < $page_counts ) {
					$templink = '<a href="' . $this->make_pagenumlink( $page_no + 1 ) . '" class="nextpostslink" rel="prev"' . $titles[2] . '>' . $nt . '</a>';
					$liststr[] = array( $templink, 1 );
				}

				$templink = '<a href="' . $this->make_pagenumlink( $page_counts ) . '" class="last"' . $titles[3] . '>' . $tolast . '</a>';
				if ( '0' === $current_option['minimum_unit'] ) {
					if ( $page_no != $page_counts ) {
						$liststr[] = array( $templink, 1 );
					}
				} else {
					if ( $page_counts > ( $page_no + $adjacent - 1 ) ) {
						$liststr[] = array( $templink );
					}
				}

				$this->page_list = $liststr;

				// 管理画面の block においては余計なリンクを機能させないように消去する
				if ( $admin_page ) {
					$pattern = '/href="(.*?)"/';
					foreach ( $liststr as $key => $val ) {
						$liststr[ $key ][0] = preg_replace( $pattern, 'href="#"', $val[0] );
					}
					$disabled = ' disabled';
				}

				if ( 1 === $rev ) {
					$liststr = array_reverse( $liststr );
				}

				if ( '0' === $current_option['minimum_unit'] ) {
					foreach ( $liststr as $val ) {
						if ( isset ( $val[1] ) ) {
							$showstr .= $val[0];
						}
					}
				} else {
					foreach ( $liststr as $val ) {
						$showstr .= $val[0];
					}
				}
			}

			// direct jump 用のinput box 表示用の処理
			if ( $page_counts > $splcpn_above ) {
				if ( $this->url_parameter ) {
					foreach ( $this->url_parameter as $key => $val ) {
						$showstr .= '<input type="hidden" name="' . $key . '" value="' . $val . '">';
					}
				}
				$showstr .= '<span class="jumpnav"><input type="number" class="direct-jump" value="' . $page_no . '" name="paged" min="1" max="' . $page_counts . '" title="Direct Jump : input page number and push enter key."' . $disabled . ' style="display:inline;"></span>';
			}
			$showstr .= '</form>';
			$showstr .= '</div></nav>';

			return $showstr;
		}
	}

	// 翻訳ファイル読み込み関数
	private function load_text_domain() {
		if ( $this->td_loaded ) {
			return;
		}
		load_plugin_textdomain(  $this->domain, false, basename( dirname( __FILE__ ) ) . '/languages' );
		$this->td_loaded = true;
	}

	// ナロースクリーン用に必要最小限の構成にするためのスタイルを吐き出す処理
	public function echo_nr_style() {
		$tarwidth = ( int )$this->ret_option['nr_style'];
?>
		<!-- plugin Simplistic Pagenavi narrow screen style -->
		<style type="text/css">
			@media screen and (max-width:<?php echo ( string )$tarwidth; ?>px){
				.nrnodisp{
					display:none;
				}
			}
		</style>
<?php
	}
}// end class

} // if class

if ( ! isset ( $simplistic_page_navi_start ) ) {
	$simplistic_page_navi_start = new Simplistic_Page_Navi_List();

	//↓管理画面のメニューにオプション設定ページを登録する処理
	if ( is_admin() ) {
		add_action( 'admin_menu', array( $simplistic_page_navi_start, 'splcpn_add_menu' ) );
	}

	//↓ページャを表示するメインとなる関数
	function splcpn_echopager(  $dir = 0 ) {
		global $simplistic_page_navi_start;

		$args = array();
		if ( func_num_args() > 1 ) {
			$args = func_get_args();
			$args = $args[1];
			$ret = $simplistic_page_navi_start->splcpn_echopagelist( $dir, $args );
		} else {
			$ret = $simplistic_page_navi_start->splcpn_echopagelist( $dir );
		}
		echo $ret;
	}

	//↓テンプレートに指定してスタイルシートを登録する関数
	function direct_splcpn_style( $dir = 0 ) {
		global $simplistic_page_navi_start;
		$simplistic_page_navi_start->template_splcpn_style( $dir );
	}
}
?>
