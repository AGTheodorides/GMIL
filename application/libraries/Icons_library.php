<?php

class Icons_library
{

	/**
	 *	Returns the record of the current user
	 */
	public function get_user()
	{
	
		$this->load->model
	
	}

	/**
	 *	Returns a query for all icons visible to the current user
	 */
	public function get_icons()
	{
	}

	/**
	 *	Returns the record for the given icon id
	 */
	public function get_icon($icon_id)
	{
	}
	
	/**
	 *	@Returns a query for all genres
	 */
	public function get_genres()
	{
	}

	/**
	 *	Returns a query for all categories for a specific genre
	 */
	public function get_categories($genre_id)
	{
	}

	/**
	 *	Returns a query for all categories for a specific genre
	 */
	public function get_themes()
	{
	}

	/**
	 *	Returns a query for all titles for a specific icon
	 *	@returns query
	 */
	public function get_titles($icon_id)
	{
	}

	/**
	 *	Creates a new title and adds a vote for it
	 *	@returns newly created id
	 */
	public function add_title($icon_id, $title_text)
	{
	}

	/**
	 *	Deletes the title
	 */
	public function delete_title($title_id)
	{
	}

	/**
	 *	Returns a query for all definitions for a specific icon
	 */
	public function get_definitions($icon_id)
	{
	}

	/**
	 *	Creates a new definition and adds a vote for it
	 *	@returns newly created id
	 */
	public function add_definition($icon_id, $category_text)
	{
	}

	/**
	 *	Deletes the definition
	 */
	public function delete_definition($definition_id)
	{
	}

	/**
	 *	Returns a query for all images for a specific icon
	 */
	public function get_images($icon_id)
	{
	}

	/**
	 *	Creates a new image and adds a vote for it
	 *	@returns newly created id
	 */
	public function add_image($icon_id, $temp_image_id)
	{
	}

	/**
	 *	Deletes the image
	 */
	public function delete_image($image_id)
	{
	}

	/**
	 *	Returns a query for all category entries for a specific icon
	 */
	public function get_category_entries($icon_id)
	{
	}

	/**
	 *	Creates a new category entry and adds a vote for it
	 *	@returns newly created id
	 */
	public function add_category_entry($icon_id, $category_id)
	{
	}

	/**
	 *	Deletes the category entry
	 */
	public function delete_category_entry($category_entry_id)
	{
	}

	/**
	 *	Returns a query for all theme entries for a specific icon
	 */
	public function get_theme_entries($icon_id)
	{
	}

	/**
	 *	Creates a new theme entry and adds a vote for it
	 *	@returns newly created id
	 */
	public function add_theme_entry($icon_id, $theme_id)
	{
	}

	/**
	 *	Deletes the theme entry
	 */
	public function delete_theme_entry($theme_entry_id)
	{
	}

}