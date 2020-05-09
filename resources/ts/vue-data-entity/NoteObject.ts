export interface NoteObject {
    id: number;
    comment: string;
    previewImage?: string;
    preview_image?: string;
    url: string;
    evaluation: number;
    created_at: any;
}

export interface NoteApiResponse {
    data: Array<NoteObject>;
}
