/**
 * 
 */
(function (blocks, blockEditor, i18n, element, components, _) {
    var __ = i18n.__;
    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var InnerBlocks = blockEditor.InnerBlocks;

    blocks.registerBlockType('tsg/accordion-block', {
        title: __('360Giving: Accordion block', 'tsg'),
        icon: 'excerpt-view',
        category: 'layout',
        attributes: {
            title: {
                type: 'array',
                source: 'children',
                selector: 'h3',
            },
        },
        example: {
            attributes: {
                title: __('J Smith', 'tsg'),
            },
        },
        edit: function (props) {
            var attributes = props.attributes;
            return (
                el('div', { className: props.className },
                    el(RichText, {
                        tagName: 'h3',
                        inline: true,
                        placeholder: __('Title', 'tsg'),
                        value: attributes.title,
                        onChange: function (value) {
                            props.setAttributes({ title: value });
                        },
                    }),
                    el(InnerBlocks),
                )
            );
        },
        save: function (props) {
            var attributes = props.attributes;

            return (
                el('div', { className: 'accordion-list__item'},
                    el('div', { className: 'accordion accordion--expanded'},
                        el(RichText.Content, {
                            tagName: 'h3',
                            value: attributes.title,
                            className: 'accordion__trigger accordion-list__heading'
                        }),
                        el(
                            'section',
                            {className: 'prose__section accordion__extra'},
                            el(InnerBlocks.Content)
                        ),
                    ),
                )
            );
        },
    });
}(
    window.wp.blocks,
    window.wp.blockEditor,
    window.wp.i18n,
    window.wp.element,
    window.wp.components,
    window._,
));