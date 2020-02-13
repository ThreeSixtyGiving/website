/**
 * 
 */
(function (blocks, editor, i18n, element, components, _) {
    var __ = i18n.__;
    var el = element.createElement;
    var RichText = editor.RichText;
    var MediaUpload = editor.MediaUpload;

    blocks.registerBlockType('tsg/person-block', {
        title: __('360Giving: Person block', 'tsg'),
        icon: 'universal-access-alt',
        category: 'layout',
        attributes: {
            name: {
                type: 'array',
                source: 'children',
                selector: 'h2',
            },
            jobTitle: {
                type: 'array',
                source: 'children',
                selector: 'h3',
            },
            email: {
                type: 'array',
                source: 'children',
                selector: '.email',
            },
            twitter: {
                type: 'array',
                source: 'children',
                selector: '.twitter',
            },
            mediaID: {
                type: 'number',
            },
            mediaURL: {
                type: 'string',
                source: 'attribute',
                selector: 'img',
                attribute: 'src',
            },
            description: {
                type: 'array',
                source: 'children',
                selector: '.ingredients',
            },
        },
        example: {
            attributes: {
                name: __('J Smith', 'tsg'),
                jobTitle: __('Director of Fun', 'tsg'),
                mediaURL: 'https://www.fillmurray.com/300/300',
                email: 'email@example.com',
                twitter: '@twitter',
                description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum quod vel voluptas recusandae dignissimos fugit deserunt molestiae, quae, blanditiis autem nesciunt odio consectetur error facilis. Ipsum, maiores cumque quo atque. Lorem ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae magni. ',
            },
        },
        edit: function (props) {
            var attributes = props.attributes;

            var onSelectImage = function (media) {
                return props.setAttributes({
                    mediaURL: media.url,
                    mediaID: media.id,
                });
            };
            return (
                el('div', { className: props.className },
                    el(RichText, {
                        tagName: 'h2',
                        inline: true,
                        placeholder: __('Person name', 'tsg'),
                        value: attributes.name,
                        onChange: function (value) {
                            props.setAttributes({ name: value });
                        },
                    }),
                    el(RichText, {
                        tagName: 'h3',
                        inline: true,
                        placeholder: __('Job title', 'tsg'),
                        value: attributes.jobTitle,
                        onChange: function (value) {
                            props.setAttributes({ jobTitle: value });
                        },
                    }),
                    el('div', { className: 'person-image' },
                        el(MediaUpload, {
                            onSelect: onSelectImage,
                            allowedTypes: 'image',
                            value: attributes.mediaID,
                            render: function (obj) {
                                return el(components.Button, {
                                    className: attributes.mediaID ? 'image-button' : 'button button-large',
                                    onClick: obj.open
                                },
                                    !attributes.mediaID ? __('Upload Image', 'tsg') : el('img', { src: attributes.mediaURL })
                                );
                            }
                        })
                    ),
                    el(RichText, {
                        className: 'email',
                        tagName: 'p',
                        inline: true,
                        placeholder: __('Email address', 'tsg'),
                        value: attributes.email,
                        onChange: function (value) {
                            props.setAttributes({ email: value });
                        },
                    }),
                    el(RichText, {
                        className: 'twitter',
                        tagName: 'p',
                        inline: true,
                        placeholder: __('Twitter handle', 'tsg'),
                        value: attributes.twitter,
                        onChange: function (value) {
                            props.setAttributes({ twitter: value });
                        },
                    }),
                    el(RichText, {
                        className: 'description',
                        tagName: 'p',
                        inline: true,
                        placeholder: __('Biography', 'tsg'),
                        value: attributes.description,
                        onChange: function (value) {
                            props.setAttributes({ description: value });
                        },
                    }),
                )
            );
        },
        save: function (props) {
            var attributes = props.attributes;

            return (
                el('li', { className: 'card-list__item' },
                    el('article', { className: 'media-card media-card--orange'},
                        el('div', { className: 'media-card__content'},
                            el('header', { className: 'media-card__header' },
                                el(RichText.Content, {
                                    tagName: 'h3',
                                    value: attributes.name,
                                    className: 'media-card__heading'
                                }),
                                el(RichText.Content, {
                                    tagName: 'span',
                                    value: attributes.jobTitle,
                                    className: 'media-card__subtitle'
                                }),
                                el('div', {className: 'media-card__links'},
                                    el(RichText.Content, {
                                        tagName: 'a',
                                        href: 'mailto:' + attributes.email,
                                        value: attributes.email,
                                        className: 'media-card__link email'
                                    }),
                                    el(RichText.Content, {
                                        tagName: 'a',
                                        href: attributes.twitter,
                                        value: attributes.twitter,
                                        className: 'media-card__link email'
                                    }),
                                )
                            ),
                            el(RichText.Content, {
                                tagName: 'p', value: attributes.description
                            }),
                        ),
                        attributes.mediaURL &&
                        el('div', { className: 'media-card__image-wrapper' },
                            el('div', { 
                                className: 'media-card__image',
                                style: {backgroundImage: 'url(' + attributes.mediaURL + ')'} 
                            }),
                        ),
                    )
                )
            );
        },
    });
}(
    window.wp.blocks,
    window.wp.editor,
    window.wp.i18n,
    window.wp.element,
    window.wp.components,
    window._,
));