$(function()
{
  $(".dropdown-menu").menuAim(
  {
    activate : activateSubmenu,
    deactivate : deactivateSubmenu
  });
});
var $menu = $(".dropdown-menu");

function activateSubmenu(row)
{
  var $row = $(row),
      submenuId = $row.data("submenuId"),
      $submenu = $("#" + submenuId),
      offset = $row.offset(),
      top = offset.top,
      height = $menu.outerHeight(),
      menuHeight = $submenu.height(),
      width = $menu.outerWidth();
  var subMenuBottom = top + menuHeight;
  var menuBottom = $menu.offset().top + height;
  if (subMenuBottom > menuBottom)
    top = top - (subMenuBottom - menuBottom);

  $submenu.css(
  {
    display : "block",
    top : top,
    left : offset.left + width - 2//,  // main should overlay submenu
    //height: height - 2  // padding for main dropdown's arrow
  });
  $row.find("a").addClass("maintainHover");
}

function deactivateSubmenu(row)
{
  var $row = $(row),
      submenuId = $row.data("submenuId"),
      $submenu = $("#" + submenuId);

  $submenu.css("display", "none");
  $row.find("a").removeClass("maintainHover");
}

$(document).mouseout(function()
{
  $(".popover").css("display", "none");
});