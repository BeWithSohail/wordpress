( function( blocks, element, components, blockEditor, serverSideRender  ) {

    const el = element.createElement,
        { __ } = wp.i18n,
        // { ServerSideRender } = wp.components,
        // { serverSideRender: ServerSideRender } = wp,
        ServerSideRender = serverSideRender,
        Fragment = element.Fragment,
        InspectorControls = blockEditor.InspectorControls,
        TextControl = components.TextControl,
        RadioControl = components.RadioControl,
        useBlockProps = blockEditor.useBlockProps;

    blocks.registerBlockType( 'smplstc-pn/pagenum-link', {
        apiVersion: 2,
        title: 'Simplistic page-navi Block',
        icon: 'smiley',
        category: 'widgets',
        description: __( 'Since the admin page does not provide information such as the total number of pages needed to display the page-list, it is displayed as a sample with the current page number as 1 and the total number of pages as 400.', 'smplstc-pn' ),

        attributes: {
            prtid: { type: 'string', default: '0' },
            miniunit: { type: 'string', default: '1' },
            pagenum: { type: 'string', default: '1' },
            pagecount: { type: 'string', default: '400' }
        },

        edit: function ( props ) {
            const blockProps = useBlockProps();
            const {
                prtid,
                miniunit,
                pagenum,
                pagecount,
            } = props.attributes;

            return(
                el(
                    Fragment,
                    null,
                    el(
                        InspectorControls,
                        null,
                        el( 'div', { id: 'smplstc_pnctrl'},
                            el(
                                TextControl,
                                {
                                    label: __( 'only for admin page, current page number', 'smplstc-pn' ),
                                    help:'',
                                    value: pagenum,
                                    onChange: function( newValue ){ props.setAttributes( { pagenum: newValue } ) }
                                }
                            ),
                            el(
                                TextControl,
                                {
                                    label: __( 'only for admin page, page count', 'smplstc-pn' ),
                                    help:'',
                                    value: pagecount,
                                    onChange: function( newValue ){ props.setAttributes( { pagecount: newValue } ) }
                                }
                            ),
                            el(
                                RadioControl,
                                {
                                    label: __( 'id of parent element nav', 'smplstc-pn' ),
                                    selected: prtid,
                                    options: [ { label: 'bottompagelink', value: '0' },{ label: 'toppagelink', value: '1' } ],
                                    onChange: function( newValue ){ props.setAttributes( { prtid: newValue } ) }
                                }
                            ),
                            el(
                                RadioControl,
                                {
                                    label: __( 'display list of minimum unit', 'smplstc-pn' ),
                                    selected: miniunit,
                                    options: [ { label: __( 'normal', 'smplstc-pn' ), value: '1' },{ label: __( 'minimum', 'smplstc-pn' ), value: '0' } ],
                                    onChange: function( newValue ){ props.setAttributes( { miniunit: newValue } ) }
                                }
                            ),
                        ),
                    ),
                    el(
                        'div',
                        blockProps,
                        el( ServerSideRender, {
                            block: 'smplstc-pn/pagenum-link',
                            attributes: props.attributes
                        } )
                    )
                )
            );
        },
    } );
    
    /*blocks.registerBlockType( 'smplstc-pn/pagenum-link', {
        title: 'Simplistic page-navi Block',
        icon: 'smiley',
        category: 'widgets',
        description: __( 'Since the admin page does not provide information such as the total number of pages needed to display the page-list, it is displayed as a sample with the current page number as 1 and the total number of pages as 400.', 'smplstc-pn' ),

        attributes: {
            prtid: { type: 'string', default: '0' },
            miniunit: { type: 'string', default: '1' },
            pagenum: { type: 'string', default: '1' },
            pagecount: { type: 'string', default: '400' }
        },

        edit: function ({attributes, setAttributes, className, focus, id}) {
            const blockProps = useBlockProps();
            const {
                prtid,
                miniunit,
                pagenum,
                pagecount,
            } = attributes;

            return(
                el(
                    Fragment,
                    null,
                    el(
                        InspectorControls,
                        null,
                        el( 'div', { id: 'smplstc_pnctrl'},
                            el(
                                TextControl,
                                {
                                    label: __( 'only for admin page, current page number', 'smplstc-pn' ),
                                    help:'',
                                    value: pagenum,
                                    onChange: function( newValue ){ setAttributes( { pagenum: newValue } ) }
                                }
                            ),
                            el(
                                TextControl,
                                {
                                    label: __( 'only for admin page, page count', 'smplstc-pn' ),
                                    help:'',
                                    value: pagecount,
                                    onChange: function( newValue ){ setAttributes( { pagecount: newValue } ) }
                                }
                            ),
                            el(
                                RadioControl,
                                {
                                    label: __( 'id of parent element nav', 'smplstc-pn' ),
                                    selected: prtid,
                                    options: [ { label: 'bottompagelink', value: '0' },{ label: 'toppagelink', value: '1' } ],
                                    onChange: function( newValue ){ setAttributes( { prtid: newValue } ) }
                                }
                            ),
                            el(
                                RadioControl,
                                {
                                    label: __( 'display list of minimum unit', 'smplstc-pn' ),
                                    selected: miniunit,
                                    options: [ { label: __( 'normal', 'smplstc-pn' ), value: '1' },{ label: __( 'minimum', 'smplstc-pn' ), value: '0' } ],
                                    onChange: function( newValue ){ setAttributes( { miniunit: newValue } ) }
                                }
                            ),
                        ),
                    ),
                    el(
                        'div',
                        blockProps,
                        el( ServerSideRender, {
                            block: 'smplstc-pn/pagenum-link',
                            attributes: attributes
                        } )
                    )
                )
            );
        },
    } );*/
})(
    window.wp.blocks,
    window.wp.element,
    window.wp.components,
    window.wp.blockEditor,
    window.wp.serverSideRender
);

