<?php
declare(strict_types=1);

namespace Tree;

class BinaryTree
{
    /**
     * @var Node
     */
    private $root = null;

    public function root(): Node
    {
        return $this->root;
    }

    public function insert(Node $node)
    {
        if (is_null($this->root)) {
            $this->root = $node;
        }
        else {
            $this->insertInNode($node, $this->root);
        }
    }

    private function insertInNode(Node $node, Node $parent)
    {
        if ($node->equals($parent)) {
            return;
        }

        $node->incrementLevel();

        if ($node->greaterThan($parent)) {
            if ($parent->hasRight()) {
                $this->insertInNode($node, $parent->right());
            }
            else {
                $parent->setRight($node);
            }
        }
        else {
            if ($parent->hasLeft()) {
                $this->insertInNode($node, $parent->left());
            } else {
                $parent->setLeft($node);
            }
        }

    }

    /**
     * @throws TreeException
     */
    public function find(Node $node, Node $parent = null): Node
    {
        if (is_null($parent)) {
            $parent = $this->root;
        }

        if ($node->equals($parent)) {
            return $parent;
        }

        if ($node->greaterThan($parent)) {
            if (!$parent->hasRight()) {
                throw new TreeException("Not Found");
            }
            return $this->find($node, $parent->right());
        }
        else {
            if (!$parent->hasLeft()) {
                throw new TreeException("Not Found");
            }
            return $this->find($node, $parent->left());
        }
    }

    public function asArray()
    {
        if (is_null($this->root)) {
            return [];
        }
        return $this->root->asArray();
    }
}