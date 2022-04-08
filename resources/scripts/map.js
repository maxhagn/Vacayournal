tt.setProductInfo('Codepen Examples', '${analytics.productVersion}');

var markers = [];
var map = tt.map({
    key: '4iASSdlHsZOZl0NZRde1KoC56R6gvoez',
    container: 'map',
    style: 'tomtom://vector/1/basic-main',
    dragPan: !window.isMobileOrTablet()
});
var ttSearchBox = new tt.plugins.SearchBox(tt.services.fuzzySearch, {
    searchOptions: {
        key: '4iASSdlHsZOZl0NZRde1KoC56R6gvoez'
    }
});
map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());
map.addControl(ttSearchBox, 'top-left');
var searchMarkersManager = new SearchMarkersManager(map);
function getBounds(data) {
    if (data.viewport) {
        var btmRight = [data.viewport.btmRightPoint.lng, data.viewport.btmRightPoint.lat];
        var topLeft = [data.viewport.topLeftPoint.lng, data.viewport.topLeftPoint.lat];
    }
    return [btmRight, topLeft];
}
function fitToViewport(markerData) {
    if (!markerData || (markerData instanceof Array && !markerData.length)) {
        return;
    }
    var bounds = new tt.LngLatBounds();
    if (markerData instanceof Array) {
        markerData.forEach(function(marker) {
            bounds.extend(getBounds(marker));
        });
    } else {
        bounds.extend(getBounds(markerData));
    }
    map.fitBounds(bounds, { padding: 100, linear: true });
}
ttSearchBox.on('tomtom.searchbox.resultscleared', function() {
    searchMarkersManager.clear();
});
ttSearchBox.on('tomtom.searchbox.resultsfound', function(resp) {
    searchMarkersManager.draw(resp.data.results);
    fitToViewport(resp.data.results);
});
ttSearchBox.on('tomtom.searchbox.resultselected', function(resp) {
    searchMarkersManager.draw([resp.data.result]);
    fitToViewport(resp.data.result);
});

