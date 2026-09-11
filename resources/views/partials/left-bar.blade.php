<aside>

    <div class="aside-header">
        <h3>Filters</h3>
        <div class="button-field">
            <button class="mobile-only" id="toggle-filters">
                Show filters
            </button>

            <button type="button" class="reset-form" id="reset-button">
                Reset filters
            </button>
            <span>5</span>

        </div>
    </div>

    <div class="checkbox-wrapper" id="filters">
        <form id="filter" action="#" method="get">
            <x-form-section-check
                title="Property type"
                name="property-type"
                :options="$propertyTypes->pluck('name', 'id')->toArray()"
                :checked="[
                    'house'
                ]"
            />

            <x-form-section-check
                title="Style of home"
                name="style-of-home"
                :options="[
                    'a-frame' => 'A-Frame',
                    'bungalow' => 'Bungalow',
                    'cottage' => 'Cottage',
                    'dome' => ' Dome',
                    'spanish' => ' Spanish'
                ]"
                :checked="[
                    'bungalow'
                ]"
            />

            <x-form-section-select
                titleLeft="Min. price"
                titleRight="Max. price"
                :select1Options="['$1,500,000', '$1,000,000', '$500,000', 'Any']"
                :select2Options="array_reverse(['$1,500,000', '$1,000,000', '$500,000', 'Any'])"
            />

            <x-form-section-select
                titleLeft="Bedroom"
                titleRight="Bathroom"
                :select1Options="['Any', '1', '2', '3', '4']"
                :select2Options="['Any', '1', '2', '3', '4']"
            />

            <x-form-section-select
                titleLeft="Size (Min)"
                titleRight="Size (Max)"
                :select1Options="['Any', '500 Sq.ft', '1000 Sq.ft', '1500 Sq.ft', '2000 Sq.ft']"
                :select2Options="['Any', '500 Sq.ft', '1000 Sq.ft', '1500 Sq.ft', '2000 Sq.ft']"
            />

            <x-form-section-check
                title="Accessibility Features"
                name="accesibility"
                :options="[
                    'extra-wide doorways' => 'Extra-wide doorways',
                    'ramps' => 'Ramps',
                    'grab bars' => 'Grab bars',
                    'lower counter heights' => 'Lower counter heights',
                    'spanish' => 'Spanish'
                ]"
                :checked="[
                    'extra-wide doorways'
                ]"
            />
        </form>
    </div>
</aside>
