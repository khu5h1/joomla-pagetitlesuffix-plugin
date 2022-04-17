document.addEventListener("DOMContentLoaded", () => {
    const options = Joomla.getOptions('page-title-suffix');
	document.querySelectorAll('h1, h2, h3, h4, h5, h6').forEach(function(heading){heading.innerHTML+=options.pagetitlesuffix_value});
});
