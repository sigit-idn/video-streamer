"use strict";

var _document$querySelect;
var videoPlayer = document.getElementById("videoPlayer");

document.querySelectorAll("#mirrorLinks a").forEach(function (link) {
    return link.addEventListener("click", function () {
        var embedTag = link.dataset.src.match(/(<iframe|<embed|<video)/);

        if (embedTag) {
            videoPlayer.innerHTML = link.dataset.src;
        } else if (/youtu/.test(link.dataset.src)) {
            videoPlayer.innerHTML =
                '<iframe allowfullscreen width="100%" height="550px" src="https://www.youtube.com/embed/'.concat(
                    link.dataset.src.match(/(\w|-|_){11}/)[0],
                    '">\n        </iframe>'
                );
        } else if (/embed|play/.test(link.dataset.src)) {
            videoPlayer.innerHTML =
                '<iframe allowfullscreen width="100%" height="550px" src="'.concat(
                    link.dataset.src,
                    '">\n        </iframe>'
                );
        } else if (/vimeo/.test(link.dataset.src)) {
            videoPlayer.innerHTML =
                '<iframe allowfullscreen width="100%" height="550px" src="https://player.vimeo.com/video/'.concat(
                    link.dataset.src.match(/\d{9}/)[0],
                    '">\n        </iframe>'
                );
        } else {
            videoPlayer.innerHTML =
                '<video onerror="replaceTag(this)" src="'.concat(
                    link.dataset.src,
                    '" controls style="width: 100%" >'
                );
        }
    });
});
var videoDescription = document.getElementById("videoDescription");
var excerpt = videoDescription.innerHTML.slice(0, 200) + "...";
var description = videoDescription.innerHTML;
videoDescription.innerHTML = excerpt;

var isMore = true;
var descriptionToggle = document.getElementById("descriptionToggle");
if (descriptionToggle) {
    descriptionToggle.addEventListener("click", function (event) {
        isMore = !isMore;
        if (isMore) {
            event.target.innerHTML = "Show More...";
            videoDescription.innerHTML = excerpt;
        } else {
            event.target.innerHTML = "Show Less...";
            videoDescription.innerHTML = description;
        }
    });
}

var csrfToken = document.querySelector("[name=_token]").value;

document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        fetch("/add-view/" + window.location.href.split("video/")[1], {
            headers: {
                "X-CSRF-Token": csrfToken,
            },
            method: "put",
        });
    }
};

document.querySelectorAll("[id^=buyButton]").forEach(function (buyButton) {
    return buyButton.addEventListener("click", function () {
        return fetch("/add-click/" + buyButton.dataset.chapterId, {
            headers: {
                "X-CSRF-Token": csrfToken,
            },
            method: "put",
        });
    });
});
