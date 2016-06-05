(function(){var t,r,n,e,o,i,s;o=null,i=0,e=!1,n=null,r=null,s=function(t){var r,n;return r=function(t){return{h:Math.floor(t/36e5),m:Math.floor(t/6e4%60),s:Math.floor(t/1e3%60)}},r=r(t),n=[],r.h>0&&n.push(r.h),n.push("0"+r.m),n.push(r.s<10?"0"+r.s:r.s),n.join(".")},null==(t=Array.prototype).shuffle&&(t.shuffle=function(){var t,r,n,e,o;if(this.length>1)for(t=n=e=this.length-1;1>=e?1>=n:n>=1;t=1>=e?++n:--n)r=Math.floor(Math.random()*(t+1)),o=[this[r],this[t]],this[t]=o[0],this[r]=o[1];return this}),jQuery(function(t){var a,u,c,l,f,h,d,k,p,m,v,w;return h=function(){return e?c():l(tracks[i])},l=function(i){return SC.get("/tracks/"+i.track_id).then(function(e){return n=e.duration,r=e.download_url,t("button.download").addClass("active").removeAttr("disabled")}),SC.stream("/tracks/"+i.track_id).then(function(r){var a;return r.play(),o=r,a=i.artist_full?i.artist_full:i.artist,t(".trackinfo-cur .title").html(i.track_title),t(".trackinfo-cur .artist").html(a),i.artist_link&&t(".trackinfo-cur .link").html("<a href='"+i.artist_link+"'>"+i.artist_link+"</a>"),t(".curtrack-description").html(i.description).show(),t(".controller .dur").html(s(n)),t(".trackinfo").hide(),r.on("time",function(){return t(".controller .cur").html(s(r.currentTime())),t("#progress-indicator").width(r.currentTime()/n*100+"%")}),r.on("finish",function(){return f()}),t("button.playpause i").addClass("fa-pause").removeClass("fa-play"),t("ul.tracks li").removeClass("nowplaying"),t("ul.tracks li[data-id='"+i.id+"']").addClass("nowplaying"),e=!0})},c=function(){return o.pause(),t("button.playpause i").removeClass("fa-pause").addClass("fa-play"),e=!1},f=function(){return i++,i>=tracks.length&&(i=0),o&&o.seek(0),l(tracks[i])},d=function(){return i--,0>i&&(i=mytracks.length),o&&o.seek(0),l(tracks[i])},t("button.playpause").on("click",function(){return h()}),t("button.next").on("click",function(){return f()}),t("button.prev").on("click",function(){return d()}),t("button.shuffle").on("click",function(){var r;return t(this).toggleClass("active"),r=tracks[i],t(this).hasClass("active")?tracks.shuffle():tracks.sort(function(t,r){return parseFloat(t.id)-parseFloat(r.id)}),o?i=t.inArray(r,tracks):void 0}),t("button.download").on("click",function(){return window.location.href=r+"?client_id=098249c9bda43969033f485dc628827d"}),a=function(r){var e,i,s,a,u;return e=t("#progress-scrubber"),i=e.offset(),a=e.width(),u=r.clientX-i.left,s=u/a,t("#volume-indicator").width(100*s+"%"),o?o.seek(s*n):void 0},p=function(r){var e,i,s,u,c;return e=t("#progress-scrubber"),i=e.offset(),u=e.width(),c=r.clientX-i.left,s=c/u,t("#progress-scrubber").on("mousemove",a),t("#progress-indicator").width(100*s+"%"),o?o.seek(s*n):void 0},v=function(r){return t("#progress-scrubber").off("mousemove",a)},t("#progress-scrubber").on("mousedown",p),t(document).on("mouseup",v),u=function(r){var n,e,i,s,a;return n=t("#volume-scrubber"),e=n.offset(),s=n.width(),a=r.clientX-e.left,i=a/s,t("#volume-indicator").width(100*i+"%"),o?o.setVolume(i):void 0},m=function(r){var n,e,i,s,a;return n=t("#volume-scrubber"),e=n.offset(),s=n.width(),a=r.clientX-e.left,i=a/s,t("#volume-scrubber").on("mousemove",u),t("#volume-indicator").width(100*i+"%"),o?o.setVolume(i):void 0},w=function(r){return t("#volume-scrubber").off("mousemove",u)},t("#volume-scrubber").on("mousedown",m),t(document).on("mouseup",w),t("ul.tracks li").hover(function(){var r,n;return t(this).hasClass("nowplaying")?k():(r=t(this).data("id"),n=t.grep(tracks,function(t){return t.id===r}),n=n[0],t(".curtrack-description").hide(),t(".trackinfo header").html("<h3>"+n.artist+"</h3><h4>"+n.track_title+"</h4>"),t(".trackinfo section").html(n.description+"<div class='link'><a href='"+n.link+"'>website</a></div>"),t(".trackinfo").show()),this}),t("ul.tracks li").click(function(){var r,n,e;return r=t(this).data("id"),e=t.grep(tracks,function(t,n){return t.id===r}),e=e[0],n=t.inArray(e,tracks),i=n,t(".trackinfo-cur header").html(e.track_title+"<br>"+e.artist),t(".trackinfo-cur section").html(e.description),t(".tracks li").removeClass("nowplaying"),t(this).addClass("nowplaying"),l(e)}),t("nav.nav a").on("click",function(r){return r.preventDefault(),t(".content-wrapper").load(t(this).attr("href")+" #content",function(){return t(".content-wrapper").show(),t(".tracks").hide()})}),t("section.header header").on("click",function(r){return r.preventDefault(),t(".content-wrapper").hide(),t(".tracks").show()}),k=function(){return t(".curtrack-description").show(),t(".trackinfo").hide()},t(".footer .controller").hover(function(){return k()}),t(".header").hover(function(){return k()}),t(window).resize(function(){var r,n;return r=t(window).height(),n=t("section.footer").offset().top,550>r?t("section.footer").addClass("mini"):t("section.footer").removeClass("mini")}),this})}).call(this);