<?php

declare(strict_types=1);

namespace Cryptools\Domain\Common\Collection;

use Cryptools\Domain\Common\Trait\CloneArrayTrait;

class ArrayCollection implements Collection
{
    use CloneArrayTrait;

    /**
     * $items of the collection, often Entity class instances
     *
     * @var array $items
     */
    private array $items;

    /**
     * ArrayCollection constructor.
     *
     * @param array $items Populate the items.
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): Collection
    {
        $clone = clone $this;
        $clone->items = [];

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function contains($item, bool $strict = true): bool
    {
        return in_array($item, $this->items, $strict);
    }

    /**
     * {@inheritDoc}
     */
    public function get($key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }

    /**
     * {@inheritDoc}
     */
    public function has($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * {@inheritDoc}
     */
    public function keys(): array
    {
        return array_keys($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function length(): int
    {
        return count($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function mergeWith(Collection...$collections): Collection
    {
        $clone = clone $this;
        foreach ($collections as $collection) {
            $clone->items = array_merge($clone->all(), $collection->all());
        }

        return $clone;
    }

    /**
     * @inheritdoc
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     */
    public function with($key, $item): Collection
    {
        $clone = clone $this;
        $clone->items[$key] = $item;

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function without($key): Collection
    {
        $clone = clone $this;
        unset($clone->items[$key]);

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function values(): array
    {
        return array_values($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function __clone()
    {
        $this->cloneArray($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->items as $key => $item) {
            yield $key => $item;
        }
    }
}