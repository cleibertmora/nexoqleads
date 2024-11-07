export default class ServiceUrlUpdater {
    constructor(dataSettings) {
        this.dataSettings = dataSettings;
    }

    // Function to update URL with service parameter
    updateUrlWithService() {
        // Check if selected_services is available and has at least one item
        if (this.dataSettings.selected_services && this.dataSettings.selected_services.length > 0) {
            const firstService = this.dataSettings.selected_services[0];
            this.appendServiceToUrl(firstService);
        }
    }

    // Function to append service query parameter to the current URL
    appendServiceToUrl(service) {
        const url = new URL(window.location.href);
        url.searchParams.set('servicio', service);
        window.history.pushState({ path: url.href }, '', url.href);
    }
}