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
  registerBlockStyle('core/image', {
    name: 'ms-xl-n50',
    label: 'Pull out left',
  });

  acf.add_filter('color_picker_args', function( args, field ){

    // do something to args
    args.palettes = ['#1E201F', '#FFFFFF', '#F2F2F2','#FAF5E8','#DAA05B','#63A375']

    // return
    return args;

});
});
