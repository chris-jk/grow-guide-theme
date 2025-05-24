<?php
/**
 * Search Form Template
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-form-container">
        <label class="search-label" for="search-field-<?php echo $search_id; ?>">
            <span class="screen-reader-text">Search for:</span>
        </label>
        <input 
            type="search" 
            id="search-field-<?php echo uniqid(); ?>" 
            class="search-field" 
            placeholder="Search..." 
            value="<?php echo esc_attr(get_search_query()); ?>"
            name="s" 
            required
        />
        <button type="submit" class="search-submit">
            <span class="search-icon">🔍</span>
            <span class="screen-reader-text">Search</span>
        </button>
    </div>
</form>
