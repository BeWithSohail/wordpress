<?php
    $cps = headers_list();
    $cpsnonce = '';
    foreach ( $cps as $val ) {
        if ( false !== strpos( $val, 'Content-Security-Policy' ) ) {
            $pattern = '/\'nonce-([0-9a-fA-F].*?)\'/';
            if ( preg_match ( $pattern, $val, $matches ) ) {
                $cpsnonce = ' nonce="' . $matches[1] . '"';
            }
            break;
        }
    }			
?>
<!-- plugin Simplistic Pagenavi javascript js_output.php-->
<script<?php echo $cpsnonce; ?>>
    ( function() {
        function apply_style ( target, style = '' ) {// width:100%;height:auto;background-color:white;
            const styleary = style.split( ';' );

            for ( let i = 0, arylen = styleary.length; i < arylen; ++i ) {
                if ( styleary[ i ] ) {
                    const stylele = styleary[ i ].split( ':' ),
                        tmpname = stylele[0].split( '-' ),
                        elename = tmpname[0] + ( tmpname[1] ? tmpname[1][0].toUpperCase() + tmpname[1].slice(1) : '' );

                    target.style[ elename ] = stylele[1];
                }
            }
        }

        function search_main() {
            const content = document.getElementById( 'content' );

            if ( null !== content ) {
                return content;
            } else { 
                const header = document.getElementsByTagName( 'header' );

                if ( header ) {
                    const parent = header[0].parentNode,
                        childtags = parent.children;

                    for ( let i = 0, child_len = childtags.length; i < child_len; ++i ) {

                        if ( childtags[ i ].hasChildNodes() ) {

                            if ( 'ASIDE' !== childtags[ i ].tagName ) {
                                let inners = childtags[ i ].innerHTML;

                                if ( -1 !== inners.indexOf( '<article' ) ) {
                                    const gc = childtags[ i ].children;

                                    for ( let j = 0, gc_len = gc.length; j < gc_len; ++j  ) {

                                        if ( 'ARTICLE' === gc[ j ].tagName ) {
                                            return childtags[ i ];
                                        } else {
                                            let gcinner = gc[ j ].innerHTML;

                                            if ( -1 !== gcinner.indexOf( '<article' ) ) {
                                                return gc[ j ];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        window.addEventListener( 'load', function() {
            const doc = document,
                tarelem = '<?php echo $target[0]; ?>';

            let content;

            if ( 'search' === tarelem ) {
                content = search_main();
            } else {
                content = doc.getElementById( '<?php echo $target[0]; ?>' );
            }

            if ( null !== content ) {
                // 文字列として持っている HTML 文はその状態では DOM としては扱えず、
                // その場合は、DOMParser の parser.parseFromString で DOM として扱える様になる。
                const parser = new DOMParser();

                <?php if ( $inope[0] ): ?>

                    const topstyle = '<?php echo $topstyle; ?>',
                        pagertop = `<?php echo $this->splcpn_echopagelist(1); ?>`;

                    if ( pagertop ) { 
                        const tophtml = parser.parseFromString( pagertop, 'text/html' ),
                            toppager = tophtml.getElementsByTagName( 'nav' );

                        // style 適用は append, prepend の前に実行
                        // append, prepend の後では toppager, bottompager のオブジェクトがなくなってしまう。
                        if ( '' !== topstyle ) {
                            apply_style( toppager[0], topstyle );
                        }
                        content.prepend( toppager[0] );
                    }
                <?php endif; ?>

                <?php if ( $inope[1] ) : ?>
                
                    const bottomstyle = '<?php echo $bottomstyle; ?>',
                        pagerbottom = `<?php echo $this->splcpn_echopagelist(0); ?>`;

                    if ( pagerbottom ) { 

                        const bottomhtml = parser.parseFromString( pagerbottom, 'text/html' ),
                            bottompager = bottomhtml.getElementsByTagName( 'nav' );

                        if ( '' !== bottomstyle ) {
                            apply_style( bottompager[0], bottomstyle );
                        }
                        content.append( bottompager[0] );
                    }
                <?php endif; ?>
            }
        });
    }());
</script>
