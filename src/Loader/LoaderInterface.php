<?php

namespace Flex\Loader;

interface LoaderInterface
{
	function load();

	function getPath(): string;

	function isLoaded(): bool;
}
