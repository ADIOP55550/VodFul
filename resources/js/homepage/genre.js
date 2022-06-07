/*
 *   Copyright (c) 2022
 *   All rights reserved.
 */

window.initListener = (firstpage, firstPageUrl, getThumbnailComponentUrl) => {

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
                    axios.get(getThumbnailComponentUrl.trim(), {
                        params: {
                            'id': v.id,
                            'overlay': true
                        },
                        headers: {
                            "Accept": 'text/html',
                        }
                    }).then(resp2 => {
                        let div = document.createElement("div");
                        div.innerHTML = resp2.data;
                        el.appendChild(div);
                        // await new Promise(res => setTimeout(res, 70));
                    });
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


}
