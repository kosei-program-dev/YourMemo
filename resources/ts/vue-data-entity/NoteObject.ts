export interface NoteObject {
    id?: number;
    comment: string;
    previewImage?: string;
    url?: string;
    evaluation?: number;
}

export interface NoteApiResponse {
    data: Array<NoteObject>;
}
