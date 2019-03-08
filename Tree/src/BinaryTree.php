<?php
declare(strict_types=1);

namespace Tree;

class BinaryTree
{
    /**
     * @var Node
     */
    private $root = null;

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
    public function find(Node $integer, Node $parent = null): Node
    {
        if (is_null($parent)) {
            $parent = $this->root;
        }

        if ($integer->equals($parent)) {
            return $parent;
        }

        if ($integer->greaterThan($parent)) {
            if (!$parent->hasRight()) {
                throw new TreeException("Not Found");
            }
            return $this->find($integer, $parent->right());
        }
        else {
            if (!$parent->hasLeft()) {
                throw new TreeException("Not Found");
            }
            return $this->find($integer, $parent->left());
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