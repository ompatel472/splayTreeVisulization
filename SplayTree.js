// Constructor for SplayTree
function SplayTree() {
  BST.call(this);
}

SplayTree.prototype = new BST(); // Inheritance
SplayTree.prototype.constructor = SplayTree;

// Insert
SplayTree.prototype.insert = function (e) {
  var successful = BST.prototype.insert.call(this, e);
  if (!successful) return false;
  else {
    this.splay(e);
  }

  return true;
};

SplayTree.prototype.splay = function (e) {
  var path = this.path(e);
  var u = path[path.length - 1];

  for (var i = path.length - 2; i >= 0; i = i - 2) {
    if (u == this.root) {
      jAlert("out");
      return;
    }

    var v = path[i];
    if (v == this.root) {
      // zig
      this.root = u;
      if (v.left == u) {
        // Left zig
        v.left = u.right;
        u.right = v;
      } else {
        // Right zig
        v.right = u.left;
        u.left = v;
      }

      return;
    }

    var w = path[i - 1];
    if (this.root == w) this.root = u;
    else if (path[i - 2].left == w) path[i - 2].left = u;
    else path[i - 2].right = u;

    if (w.left == v && v.left == u) {
      // Left zig-zig
      v.left = u.right;
      w.left = v.right;
      v.right = w;
      u.right = v;
    } else if (w.right == v && v.right == u) {
      // Right zig-zig
      w.right = v.left;
      v.left = w;
      v.right = u.left;
      u.left = v;
    } else if (w.left == v && v.right == u) {
      // Left zig-zag
      v.right = u.left;
      w.left = u.right;
      u.right = w;
      u.left = v;
    } else if (w.right == v && v.left == u) {
      // Right zig-zag
      w.right = u.left;
      v.left = u.right;
      u.right = v;
      u.left = w;
    }
  }
};

SplayTree.prototype.search = function (e) {
  var parent = null; // Parent node for current
  var current = this.root; // Start from the this.root

  while (current != null) {
    if (e < current.element) {
      parent = current;
      current = current.left;
    } else if (e > current.element) {
      parent = current;
      current = current.right;
    } else {
      this.splay(current.element);
      return true; // Element is found
    }
  }

  if (parent != null) this.splay(parent.element);
  return false;
};

// Delete an element from the binary tree.

SplayTree.prototype.delete = function (element) {
  if (this.root == null) return false; // Element is not in the tree

  var parent = null;
  var current = this.root;
  while (current != null) {
    if (element < current.element) {
      parent = current;
      current = current.left;
    } else if (element > current.element) {
      parent = current;
      current = current.right;
    } else break;
  }

  if (current == null) {
    if (parent != null) this.splay(parent.element);
    return false; // Element is not in the tree
  }

  if (current.left == null) {
    if (parent == null) {
      this.root = current.right;
    } else {
      if (element < parent.element) parent.left = current.right;
      else parent.right = current.right;

      this.splay(parent.element);
    }
  } else {
    var parentOfRightMost = current;
    var rightMost = current.left;

    while (rightMost.right != null) {
      parentOfRightMost = rightMost;
      rightMost = rightMost.right;
    }

    current.element = rightMost.element;

    if (parentOfRightMost.right == rightMost)
      parentOfRightMost.right = rightMost.left;
    else parentOfRightMost.left = rightMost.left;

    this.splay(parentOfRightMost.element);
  }

  this.size--;
  if (parent != null) this.splay(parent.element);
  return true; // Element inserted
};
