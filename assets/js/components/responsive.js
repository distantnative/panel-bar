!function(e){var l=e.dom.wrapper,n=function(){var n=e.status.visible;n||e.show(),cl.add(l,"panelBar--mobile"),i.data.mobile=r(),cl.remove(l,"panelBar--mobile"),i.data.desktop=r(),n||e.hide(),a()},a=function(){var n=l.offsetWidth;e.status.visible||(e.show(),n=l.offsetWidth,e.hide()),n<i.data.desktop?cl.add(l,"panelBar--mobile"):cl.remove(l,"panelBar--mobile"),t()},r=function(){var l,n=e.dom.controls.all.offsetWidth+20,a=e.dom.bar.querySelectorAll(".panelBar-element");for(l=0;l<a.length;l++)n+=a[l].offsetWidth;return n},t=function(){var l,n=e.dom.bar.querySelectorAll(".panelBar-mDrop");for(l=0;l<n.length;l++){cl.remove(n[l],"panelBar-element--overlap"),cl.remove(n[l],"panelBar-element--overlap");var a=n[l].getBoundingClientRect();a.left<0?cl.add(n[l],"panelBar-element--overlap"):a.right<0&&cl.add(n[l],"panelBar-element--overlap")}},o=function(){return"querySelector"in document&&"addEventListener"in window};e.responsive={data:{resize:null,mobile:null,desktop:null},init:function(){o&&(n(),setTimeout(n,300),window.addEventListener("resize",a))}};var i=e.responsive}(panelBar),panelBar.responsive.init();