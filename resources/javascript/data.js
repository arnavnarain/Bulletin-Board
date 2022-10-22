var defaultThreads = [
    {
        id: 1,
        title: "Thread 1",
        author: "Arnav",
        date: Date.now(),
        content: "Sample thread 1",
        comments: [
            {
                author: "Srikar",
                date: Date.now(),
                content: "Sample comment 1"
            },
            {
                author: "Arnav", 
                date: Date.now(),
                content: "Sample comment 2:"
            }
        ]
    },
    {
        id: 2,
        title: "Thread 2",
        author: "Srikar",
        date: Date.now(),
        content: "Sample thread 2",
        comments: [  {
                author: "Arnav", 
                date: Date.now(),
                content: "Sample comment 2:"
            }]
    }
]


var threads = defaultThreads;
if(sessionStorage.getItem('newThreads') == null) { 
sessionStorage.setItem('newThreads', JSON.stringify(threads));
}

