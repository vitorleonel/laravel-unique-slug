<?php

namespace VitorLeonel\UniqueSlug;

use Illuminate\Database\Eloquent\Collection;

/**
 * UniqueSlug class
 */
class UniqueSlug {

	/**
	 * Generate a new slug with random hash.
	 * 
	 * @var string
	 */
	private $hash_mode = false;

	/**
	 * Hash length.
	 * 
	 * @var integer
	 */
	private $hash_length = 5;

	/**
	 * Define hash mode.
	 * 
	 * @param bool|boolean $active
	 */
	public function setHashMode(bool $active = false) {
		$this->hash_mode = $active;

		return $this;
	}

	/**
	 * Define hash length.
	 * 
	 * @param int|integer $length
	 */
	public function setHashLength(int $length = 5) {
		$this->hash_length = $length;

		return $this;
	}

	/**
	 * Make a unique slug for a specific model.
	 * 
	 * @param  string      $model
	 * @param  string      $value
	 * @param  int|integer $id
	 * 
	 * @return string
	 */
	public function make(string $model, string $value, int $id = null) : string
	{
		$slug = str_slug($value);
		$allSlugs = $this->getRelatedSlugs($model, $slug, $id);

		if(!$allSlugs->contains('slug', $slug)) {
			return $slug;
		}

		return $this->generateUniqueSlug($allSlugs, $slug);
	}

	/**
	 * Retrieve all recods with slug.
	 * 
	 * @param  string      $model
	 * @param  string      $value
	 * @param  int|integer $id
	 * 
	 * @return Collection
	 */
	private function getRelatedSlugs(string $model, string $slug, int $id = null) : Collection
	{
		$slugs = app($model)->select('slug')->where('slug', 'like', $slug . '%');

		if($id) {
			$slugs = $slugs->where('id', '<>', $id);
		}

		return $slugs->get();
	}

	/**
	 * Generate a new unique slug.
	 * 
	 * @param  Collection 	$allSlugs
	 * @param  string 		$slug
	 * 
	 * @return string
	 */
	private function generateUniqueSlug(Collection $allSlugs, string $slug) : string
	{
		$suffix = !$this->hash_mode ? 1 : str_random($this->hash_length);

		while (true) {
			$newSlug = strtolower($slug . '-' . $suffix);

			if(!$allSlugs->contains('slug', $newSlug)) {
				return $newSlug;
			}

			$suffix++;
		}
	}

}