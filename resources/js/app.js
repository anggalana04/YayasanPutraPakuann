import './bootstrap';

// Global HTMX route loading indicator (non-spinner)
if (!window.__htmxRouteLoaderInit) {
	window.__htmxRouteLoaderInit = true;

	const ensureRouteLoader = () => {
		if (document.querySelector('.htmx-route-loader')) return;
		const loader = document.createElement('div');
		loader.className = 'htmx-route-loader';
		loader.setAttribute('aria-hidden', 'true');
		document.body.appendChild(loader);
	};

	const startLoading = () => {
		if (!document.body) return;
		ensureRouteLoader();
		document.body.classList.add('is-htmx-loading');
	};

	const stopLoading = () => {
		if (!document.body) return;
		document.body.classList.remove('is-htmx-loading');
	};

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', ensureRouteLoader);
	} else {
		ensureRouteLoader();
	}

	document.addEventListener('htmx:beforeRequest', startLoading);
	document.addEventListener('htmx:afterSettle', stopLoading);
	document.addEventListener('htmx:responseError', stopLoading);
	document.addEventListener('htmx:sendError', stopLoading);
	document.addEventListener('htmx:historyRestore', stopLoading);
	window.addEventListener('pageshow', stopLoading);
}
