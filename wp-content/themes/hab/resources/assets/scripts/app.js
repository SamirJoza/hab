/**
 * External Dependencies
 */
import 'jquery';
import 'bootstrap';

import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { faBars } from '@fortawesome/free-solid-svg-icons';
import { 
  faLinkedin,
  faFacebookSquare,
  faTwitterSquare,
  faYoutubeSquare,
  faInstagramSquare,
  faSnapchatSquare,
  faTiktok
} from '@fortawesome/free-brands-svg-icons';
library.add(
  faBars, 
  faLinkedin,
  faFacebookSquare,
  faTwitterSquare,
  faYoutubeSquare,
  faInstagramSquare,
  faSnapchatSquare,
  faTiktok
  );
dom.watch();

$(document).ready(() => {
  // console.log('Hello world');
});
