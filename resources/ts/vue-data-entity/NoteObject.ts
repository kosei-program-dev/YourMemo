export interface NoteObject {
    id?: number;
    comment: string;
    previewImage?: string;
    url?: string;
    evaluation?: number;
    created_at?: number;
}

export interface NoteApiResponse {
    data: Array<NoteObject>;
}
