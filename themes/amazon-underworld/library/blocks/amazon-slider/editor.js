import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { __experimentalNumberControl as NumberControl } from '@wordpress/components';

import {
    PanelBody,
    TextControl,
    ToggleControl,
    PanelRow,
    SelectControl,
    Disabled,
} from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import metadata from './block.json';

export default function Edit({ attributes, setAttributes }) {
    const {
        categorySlugs,
        numberOfPosts,
        orderBy,
        order,
        externalLinkMetaKey,
        displayAuthorMetaKey,
        slidesPerViewDesktop,
        slidesPerViewTablet,
        slidesPerViewMobile,
        loopSlides,
    } = attributes;

    const blockProps = useBlockProps();

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Content Source Settings', 'hacklabr')}>
                    <PanelRow>
                        <TextControl
                            label={__('Category Slugs (comma-separated)', 'hacklabr')}
                            value={categorySlugs}
                            onChange={(value) => setAttributes({ categorySlugs: value })}
                            help={__('Enter one or more category slugs, separated by commas (e.g., "news,events").', 'hacklabr')}
                        />
                    </PanelRow>
                    <PanelRow>
                        <NumberControl
                            label={__('Number of Posts', 'hacklabr')}
                            value={numberOfPosts}
                            onChange={(value) => setAttributes({ numberOfPosts: value })}
                            min={1}
                            max={20}
                        />
                    </PanelRow>
                    <PanelRow>
                        <SelectControl
                            label={__('Order By', 'hacklabr')}
                            value={orderBy}
                        options={[
                            { label: __('Date', 'hacklabr'), value: 'date' },
                            { label: __('Title', 'hacklabr'), value: 'title' },
                            { label: __('Random', 'hacklabr'), value: 'rand' },
                        ]}
                            onChange={(value) => setAttributes({ orderBy: value })}
                        />
                    </PanelRow>
                    <PanelRow>
                        <SelectControl
                            label={__('Order', 'hacklabr')}
                            value={order}
                        options={[
                            { label: __('Descending (DESC)', 'hacklabr'), value: 'DESC' },
                            { label: __('Ascending (ASC)', 'hacklabr'), value: 'ASC' },
                        ]}
                            onChange={(value) => setAttributes({ order: value })}
                        />
                    </PanelRow>
                    <PanelRow>
                        <TextControl
                            label={__('External Link Custom Field Name', 'hacklabr')}
                            value={externalLinkMetaKey}
                            onChange={(value) => setAttributes({ externalLinkMetaKey: value })}
                            help={__('E.g., infoamazonia_redirect_url. This field on each post must contain the full external URL.', 'hacklabr')}
                        />
                    </PanelRow>
                    <PanelRow>
                        <TextControl
                            label={__('Display Author Meta Key', 'hacklabr')}
                            value={displayAuthorMetaKey}
                            onChange={(value) => setAttributes({ displayAuthorMetaKey: value })}
                            help={__('E.g., displayed_author_name. This field on each post must contain the author name to display.', 'hacklabr')}
                        />
                    </PanelRow>
                </PanelBody>

                <PanelBody title={__('Slider Layout Settings', 'hacklabr')}>
                    <PanelRow>
                        <ToggleControl
                            label={__('Infinite Loop', 'hacklabr')}
                            checked={!!loopSlides}
                            onChange={(value) => setAttributes({ loopSlides: value })}
                        />
                    </PanelRow>
                    <PanelRow>
                        <NumberControl
                            label={__('Slides Per View (Desktop)', 'hacklabr')}
                            value={slidesPerViewDesktop}
                            onChange={(value) => setAttributes({ slidesPerViewDesktop: value })}
                            min={1} max={6}
                        />
                    </PanelRow>
                    <PanelRow>
                        <NumberControl
                            label={__('Slides Per View (Tablet)', 'hacklabr')}
                            value={slidesPerViewTablet}
                            onChange={(value) => setAttributes({ slidesPerViewTablet: value })}
                            min={1} max={4}
                        />
                    </PanelRow>
                    <PanelRow>
                        <NumberControl
                            label={__('Slides Per View (Mobile)', 'hacklabr')}
                            value={slidesPerViewMobile}
                            onChange={(value) => setAttributes({ slidesPerViewMobile: value })}
                            min={1} max={2}
                        />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                <Disabled>
                    <ServerSideRender
                        block={metadata.name}
                        attributes={attributes}
                    />
                </Disabled>
            </div>
        </>
    );
}

import { registerBlockType } from '@wordpress/blocks';
registerBlockType(metadata.name, {
    edit: Edit,
});