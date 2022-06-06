/*
 *   Copyright (c) 2022
 *   All rights reserved.
 */
window.initListener = (firstpage, firstPageUrl) => {

    let first_url = firstPageUrl + "?page=" + firstpage;
    let curr_url = firstPageUrl + "?page=" + firstpage;
    let next_url = firstPageUrl + "?page=" + firstpage;
    let prev_url = null;

    UIkit.util.on("#bottom-detector", "inview", () => {
        console.log("Inview 1");
        console.log("Getting page with url", next_url);
        if (next_url === null)
            return;
        axios.get(next_url, {
            headers: {
                "Accept": "application/json"
            }
        })
            .then(async resp => {
                console.dir(resp.data);
                first_url = resp.data.links.first;
                next_url = resp.data.links.next;
                prev_url = resp.data.links.prev;
                curr_url = resp.data.meta.path;
                let el = document.querySelector("#movies-list");
                for (const v of resp.data.data) {
                    let div = document.createElement("div");
                    div.innerHTML = template(v);
                    el.appendChild(div);
                    await new Promise(res => setTimeout(res, 70));
                }
                if (next_url === null) {
                    let div = document.createElement("div");
                    let endMarker = document.createElement("h4");
                    endMarker.textContent = "End";
                    endMarker.classList.add("uk-text-center");
                    div.appendChild(endMarker);
                    console.log(el.parentElement)
                    el.parentElement.appendChild(div);
                }
            });
    });
    UIkit.util.on("#bottom-detector", "outview", () => {
        console.log("Outview 1");
    });

    let template = (movie) => `
    <div
    class="uk-inline uk-dark uk-visible-toggle uk-animation-toggle uk-animation-slide-top">
        <img loading="lazy"
             src="${movie.thumbnailUrl}"
             width="200"
             style="aspect-ratio: 2/3"
             alt="">
        <div
            class="uk-overlay-primary uk-position-cover uk-invisible-hover uk-animation-fade uk-animation-fast uk-hidden-touch">
            <div class="uk-position-top uk-height-1-1">
                <a href="/movie/${movie.id}" class="uk-text-decoration-none">
                    <div
                        class="uk-invisible-hover uk-animation-slide-top-medium uk-animation-fast uk-margin-small-top uk-padding-small uk-height-max-small">${movie.title}</div>
                    <span uk-icon="icon: play-circle; ratio: 2"
                          class="uk-text-center uk-width-1-1 uk-margin-small-top"></span>
                </a>

                <div
                    class="uk-position-bottom uk-flex uk-flex-between uk-width-1-1 uk-margin-small-bottom uk-padding-small" style="pointer-events: none">
                    <a href="/movie/ban/${movie.id}" style="pointer-events: all" uk-icon="icon: ban"
                       uk-tooltip="Nie interesuje mnie to">
                    </a>
                    <a href="/movie/fav/${movie.id}" style="pointer-events: all" uk-icon="icon: plus"
                       uk-tooltip="Dodaj do mojej listy">
                    </a>
                </div>
            </div>
        </div>
        <div
            class="uk-overlay uk-hidden-notouch uk-position-cover" uk-toggle="target: #movie-modal-${movie.hashid}"></div>

        <div>
<!--            MODAL-->
            <div id="movie-modal-${movie.hashid}" uk-modal
                 class="uk-hidden-notouch uk-modal-full uk-animation-slide-bottom uk-light"
                 style="background: rgba(26,32,44,0.67)">
                <div class="uk-modal-dialog uk-background-secondary">
                    <button class="uk-modal-close-full uk-background-secondary uk-light" type="button"
                            uk-close></button>
                    <div class="uk-modal-header uk-background-secondary">
                        <h2 class="uk-modal-title">${movie.title}</h2>
                    </div>
                    <div class="uk-modal-body">
                        <img loading="lazy"
                             class="uk-align-center uk-height-max-medium"
                             src="${movie.thumbnailUrl}"
                             alt="">
                        <p>${movie.description}</p>
                    </div>
                    <div class="uk-modal-footer uk-text-right uk-background-secondary">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
                        <a href="/movie/${movie.id}" class="uk-button uk-button-primary" type="button">Watch
                            <span
                                class="uk-margin-small-right" uk-icon="play"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>`;


}
