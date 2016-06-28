<?php

namespace Flex\Loader;

class JsonLoader implements LoaderInterface
{
	private $path;
	private $source;

	public function __construct($path = null, array $arguments = null)
	{
		$this->setPath($path, $arguments);
	}

	public function load()
	{
		if(null === $this->path) throw new \RuntimeException("No path given to load file.");

		if(null === $this->source) {
			$source = file_get_contents($this->path);
			if(false === $this->source)
				throw new \RuntimeException("Loaded file cannot be found.");
			$this->source = json_decode($source);
		}

		return $this->source;
	}

	public function isLoaded(): bool
	{
		return isset($this->source);
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function setPath($path, array $arguments = null)
	{
		if(null !== $arguments)
			$path = sprintf($path, $arguments);
		$this->path = $path;
	}
}
