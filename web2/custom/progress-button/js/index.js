(function() {
  var button, parent;

  button = document.querySelector("button");

  parent = button.parentElement;

  button.addEventListener("click", function() {
    parent.classList.add("clicked");
    return setTimeout((function() {
      return parent.classList.add("success");
    }), 2600);
  });

  balapaCop("Upload Progress Interaction", "#999");

}).call(this);