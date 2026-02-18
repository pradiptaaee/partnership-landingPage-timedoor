import { previewHero } from './hero.js';
import * as BannerFunctions from './banner.js'; 
import * as TestimonialFunctions from './testimonial.js';
import * as ProjectFunctions from './project.js';

window.LandingPage = {
    previewHero: previewHero,
    previewBanner: BannerFunctions.previewBanner,
    updatePreviewBanner: BannerFunctions.updatePreviewBanner,
    previewTestimonialImage: TestimonialFunctions.previewTestimonialImage,
    updateTestimonialPreview: TestimonialFunctions.previewTestimonialImage,
    previewProjectImage: ProjectFunctions.previewProjectImage,
    updateProjectPreview: ProjectFunctions.previewProjectImage
};

window.BannerManager = {
    prepareDelete: BannerFunctions.prepareDelete,
    closeModal: BannerFunctions.closeModal
};

console.log('LandingPage JS Module Loaded');