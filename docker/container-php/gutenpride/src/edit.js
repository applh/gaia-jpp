/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
import { TextControl } from '@wordpress/components';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';


/**
 * GAIA HACK: add a component
 */
import { useState, useEffect, useLayoutEffect, useSyncExternalStore } from 'react';
import XpMain from './XpMain';
import { XpData, XpButton2 } from './XpMain';

function XpButton () {
	return (
		<>
			<button>{XpMain.title}</button>
			<ul>{ XpMain.listItems }</ul>
		</>
	)
}

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	// warning: Gutenberg will call this function many times
	console.log('Edit', attributes, setAttributes);

	const blockProps = useBlockProps();

	// warning: this is common to the block, not shared between blocks
	const [counter, setCounter] = useState(0);
    function handleClick() {
        setCounter(counter + 1);

		// share counter between all blocks
		XpData.setSnapshot(XpData.counter + 1);
        console.log('You clicked me!', counter, XpData.counter);
    }

	return (
		<div { ...blockProps }>
			<TextControl
				value={ attributes.message }
				onChange={ ( val ) => setAttributes( { message: val } ) }
			/>
			<XpButton/>
			<XpButton2 counter={counter} onClick={handleClick} />
			<h1>{ counter }</h1>
			<XpButton2 counter={counter} onClick={handleClick} />
		</div>
	);
}
