export const markdownform = function() {

    const textEl = document.getElementById('markdown-form-text')
    const textPreview = document.getElementById('markdown-form-preview')
    let currentText = textEl.innerHTML
    let processing = false

    async function postData(text) {
        const response = await fetch(markdownPreviewRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                text: text
            })
        })

        if (response.ok && response.status === 200) {
            const data = await response.json()
            return data.text
        }
        return false;
    }

    function setPreview(text) {
        textPreview.innerHTML = text
    }

    function update() {
        if (processing || currentText == textEl.value) {
            return;
        }

        currentText = textEl.value
        processing = true
        postData(currentText)
            .then((data) => {
                if (data !== false) {
                    setPreview(data)
                }
                processing = false
                if (currentText != textEl.value) {
                    update()
                }
            })
    }

    textEl.oninput = () => {
        update()
    }
}()
