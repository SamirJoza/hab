import '@wordpress/edit-post';
import domReady from '@wordpress/dom-ready';
import { unregisterBlockStyle, registerBlockStyle } from '@wordpress/blocks';

domReady(() => {
  unregisterBlockStyle('core/button', 'outline');
  unregisterBlockStyle('core/button', 'fill');

  registerBlockStyle('core/button', {
    name: 'btn-primary',
    label: 'Primary',
  });
  registerBlockStyle('core/button', {
    name: 'btn-secondary',
    label: 'Secondary',
  });
  registerBlockStyle('core/button', {
    name: 'button-outline-light',
    label: 'White Outline',
  });
  registerBlockStyle('core/button', {
    name: 'btn-link',
    label: 'Link',
  });
  registerBlockStyle('core/heading', {
    name: 'sidemarker-brand-3',
    label: 'Side Marker Orange',
  });
});
